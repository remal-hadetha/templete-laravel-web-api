<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Http\Requests\Api\Cart\AddRequest;
use App\Http\Requests\Api\Cart\ProductSearch;
use App\Http\Requests\Api\Cart\DeleteProductRequest;
use App\Http\Resources\CartProductsResource;
use App\Http\Resources\ProductsResource;
class CartController extends Controller
{
    //
    private $resource;
    private $data;
    private $successCode;
    private $successMessage;
    private $failMessage;
    public function __construct(){
        $this->data           = [];
        $this->successCode    = 200;
        $this->serverErrorCode    = 500;
        $this->successMessage = 'Request Done successfully';
        $this->failMessage    = 'server Error With Details => ';
    }


    public function search(ProductSearch $request)
    {
        try{
        $products = Product::where('name_ar','like','%'.$request->key.'%')->get();
        $this->data = ProductsResource::collection($products);
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }


    public function add(AddRequest $request)
    {
        try{
        $user = auth()->user();
        $cart = Cart::where('user_id',auth()->user()->id)->first();
        $product = Product::find($request->product_id);
        if($cart){
            $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
            if($cartProduct){
                $cart->total -= $product->price * $cartProduct->quantity;
                $cart->save();
                $cartProduct->delete();

                $cart->total  += $product->price * $request->quantity;
                $cart->save();
                $newCartProduct          = new CartProduct();
                $newCartProduct->cart_id    = $cart->id;
                $newCartProduct->product_id = $product->id;
                $newCartProduct->quantity   = $request->quantity;
                $newCartProduct->save();
                return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }else{
                if($cart->total != '' && $cart->total != null){
                    $cart->total  += $product->price * $request->quantity;
                }else{
                    $cart->total  = $product->price * $request->quantity;
                }
                $cart->save();
                $newCartProduct          = new CartProduct();
                $newCartProduct->cart_id    = $cart->id;
                $newCartProduct->product_id = $product->id;
                $newCartProduct->quantity   = $request->quantity;
                $newCartProduct->save();
                return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
            }
        }else{
            $newCart = new Cart();
            $newCart->user_id = $user->id;
            $newCart->total   = $product->price * $request->quantity;
            $newCart->save();
            
            $cartProduct = new CartProduct();
            $cartProduct->cart_id = $newCart->id;
            $cartProduct->product_id = $product->id;
            $cartProduct->quantity = $request->quantity;
            $cartProduct->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }
        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function cartproudctsCount()
    {
        try{

            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $count =  $cart->products->count();
            return response()->json(['data'=>$count,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }


    public function viewCart()
    {
        try{
            $user = auth()->user();
            if(!$user){
                return response()->json(['data'=>$this->data, 'message'=>'Please Login','status'=>401]);
            }
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            if(!$cart){
                return response()->json(['data'=>$this->data, 'message'=>'You Are Don\'t Have Any prodcts in cart','status'=>200]);
            }
            $cartproudcts = CartProduct::where('cart_id',$cart->id)->get();
            $this->data['total'] = $cart->total;
            $this->data['products'] = CartProductsResource::collection($cartproudcts);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function update()
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $product = Product::find($request->product_id);
            if($cart){
                $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
                if($cartProduct){
                    return response()->json(['data'=>$this->data,'message'=>'This Product Already in cart','status'=>$this->successCode]);
                }else{
                    $cart->total  += $product->price;
                    $cart->save();
                    
                    $newCartProduct          = new CartProduct();
                    $newCartProduct->cart_id    = $cart->id;
                    $newCartProduct->product_id = $product->id;
                    $newCartProduct->quantity   = '1';
                    $newCartProduct->save();
                    return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
                }
            }else{
                $newCart = new Cart();
                $newCart->user_id = $user->id;
                $newCart->total   = $product->price;
                $newCart->save();
                
                $cartProduct = new CartProduct();
                $cartProduct->cart_id = $newCart->id;
                $cartProduct->product_id = $product->id;
                $cartProduct->quantity = '1';
                $cartProduct->save();
                return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    
            }
            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    
    }

    public function delete(DeleteProductRequest $request)
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $product = Product::find($request->product_id);
            if($cart){
                $cartProduct = CartProduct::where(['cart_id'=>$cart->id,'product_id'=>$product->id])->first();
                if($cartProduct){
                    $cart->total -= $product->price * $cartProduct->quantity;
                    $cart->save();
                    $cartProduct->delete();
                    return response()->json(['data'=>$this->data,'message'=>'Product Deleted','status'=>$this->successCode]);
                }else{

                    return response()->json(['data'=>$this->data,'message'=>'Product Dosn\'t exists ','status'=>$this->successCode]);
                }
            }

            }catch (Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    
    }
    //create order on continue shopping

}
