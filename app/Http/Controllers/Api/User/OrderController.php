<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Order\CreateAddressRequest;
use App\Http\Requests\Api\Order\CreateOrderRequest;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Http\Requests\Api\Order\AddressRequest;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;
use App\Models\User;
use App\Models\ImageOrder;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderProducts;
use App\Http\Resources\MiniOrderResource;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\AddressResource;
use App\Http\Requests\Api\Order\ApplyCopounRequest;
use App\Http\Requests\Api\Order\CancelOrderRequest;
use App\Models\Payment;

class OrderController extends Controller
{
    private $resource;
    private $data;
    private $successCode;
    private $successMessage;
    private $failMessage;
    public function __construct(){
        $this->data           = null;
        $this->successCode    = 200;
        $this->serverErrorCode    = 500;
        $this->noDataCode    = 422;
        $this->noDataMessage = 'لايوجد بيانات';
        $this->successMessage = 'تم بنجاح';
        $this->failMessage    = 'خطأ في الخادم  => ';
    }

    public function addAddress(CreateAddressRequest $request)
    {
        try{
            $user = auth()->user();
            $address = new Address();
            $address->lat        = $request->lat;
            $address->long       = $request->long;
            $address->user_id    = $user->id;
            $address->type       = $request->type;
            $address->number     = $request->number;
            $address->desc       = $request->details;
            $address->near_place = $request->near_place;
            $address->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }

    }

    public function getAddresses()
    {
        try{
            $user = auth()->user();
            $addresses =  Address::where('user_id',$user->id)->get();
            $this->data = AddressResource::collection($addresses);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }


    public function getAddress(AddressRequest $request)
    {
        try{
            $user = auth()->user();

            $address =  Address::where('id',$request->address_id)->first();

            $this->data =new AddressResource($address);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }


    public function updateAddress(AddressRequest $request)
    {

        try{
            $user = auth()->user();
            $address = Address::find($request->address_id);
            if($request->lat){
                $address->lat        = $request->lat;
            }
            if($request->long){
                $address->long       = $request->long;
            }
            if($request->type){
                $address->type       = $request->type;
            }

            if($request->number){
                $address->number     = $request->number;
            }

            if($request->details){
                $address->desc       = $request->details;
            }
            if($request->near_place){
                $address->near_place = $request->near_place;
            }
            $address->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }


    }

    public function deleteAddress(AddressRequest $request)
    {
        try{
            $user = auth()->user();
            $address = Address::find($request->address_id);
            $address->delete();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function continueShopping()
    {
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',auth()->user()->id)->first();
            $cartproudcts = CartProduct::where('cart_id',$cart->id)->get();

            $this->data['sub_total'] = $cart->total;
            $this->data['delivery']  = 10;
            $tax = 75;
            if(SETTING_VALUE('tax') !='' && SETTING_VALUE('tax') !=null ){
                $tax = SETTING_VALUE('tax');
            }
            $this->data['tax']    = $tax;


            $this->data['total']     = $cart->total + $this->data['delivery'] + $this->data['tax'];
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function myOreders()
    {
        $orders = Order::where('user_id',auth()->user()->id)->orderBy('id', 'DESC')->get();
        $this->data['orders'] = MiniOrderResource::collection($orders);
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    }

    public function newOrder(CreateOrderRequest $request)
    {
        try{
            if ($request->coupoun_id) {
                $coupoun = Coupon::find($request->coupoun_id);
                if (!$coupoun) {
                    return response()->json(['data'=>$this->data,'message'=>$this->noDataMessage,'status'=>$this->noDataCode],$this->noDataCode);
                }
                // $coupoun->used = '1';
                // $coupoun->user_id = auth()->user()->id;
                // $coupoun->save();
            }

            $user = auth()->user();
            $order = new Order ();
            $order->user_id        = $user->id;
            $order->driver_id      = $request->salon_id;
            $order->date           = $request->date;
            $order->time           = $request->from_time;
            $order->from_time      = $request->from_time;
            $order->to_time        = $request->to_time;
            $order->sub_total      = $request->total;
            $order->status         = 'pending'; // pending - received - inprogress - delivered - cancelled
            $order->payment_type   = $request->payment_type;
            $order->save();
            $order->services()->sync($request->services);
            if($request->images){
                foreach($request->images as $image){
                    $newOrderImage = new ImageOrder();
                    $image_name = time(). $image->getClientOriginalName();
                    $image->move(storage_path('app/public/uploads/orders/'),$image_name);
                    $newOrderImage->image = $image_name;
                    $newOrderImage->order_id = $order->id;
                    $newOrderImage->save();
                }
            }

            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->user->name . ' بطلب حجز جديد ' ;
            $notifiacation->value_ar = 'قام ' . $order->user->name . '   بطلب حجز جديد رقم  ' . $order->id ;
            $notifiacation->order_id = $order->id;
            $notifiacation->provider_id = $order->driver_id;
            $notifiacation->type = 'provider';
            $notifiacation->save();

            $notifiy = [
                'title'=>$notifiacation->title_ar,
                'body'=>$notifiacation->value_ar,
                'type'=>'provider',
                'order_id'=>$order->id,
            ];

            $provider_id = $order->driver_id;
            if($provider_id != null){
                pushFcmNotes($notifiy,$provider_id);
            }

            $payment = new Payment();
            $payment->order_id = $order->id;
            if ($request->coupoun_id) {
            $payment->coupoun_id = $request->coupoun_id;
            }

            $payment->save();

            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage ,'status'=>$this->successCode]);

        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function applyCopun(ApplyCopounRequest $request)
    {
        $coupoun = Coupon::where('name',$request->coupoun)->first();
        if($coupoun){
            if($coupoun->value != null && $coupoun->value != '' && $coupoun->used != '1'){
                $value = $coupoun->value;
                $this->data['value'] = $value;
                $this->data['id']    = $coupoun->id;

                return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);

            }else{
                return response()->json(['data'=>$this->data, 'message'=>'هذا الكوبون مستخدم من قبل ','status'=>$this->noDataCode],$this->noDataCode);
            }
        }else{
        return response()->json(['data'=>$this->data, 'message'=>'هذا الكوبون  غير متوفر ','status'=>$this->noDataCode],$this->noDataCode);
        }

    }

    public function cancelOrder(CancelOrderRequest $request)
    {

        try{
            $order = Order::find($request->order_id);
            $order->cancel_status = $request->reason;
            $order->status = 'cancelled';
            $order->save();

            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->user->name . ' بإلغاء الطلب ' ;
            $notifiacation->value_ar = 'قام ' . $order->user->name . ' بإلغاء الطلب رقم  ' . $order->id ;
            $notifiacation->order_id = $order->id;
            $notifiacation->provider_id = $order->driver_id;
            $notifiacation->type = 'provider';
            $notifiacation->save();

            $notifiy = [
                'title'=>$notifiacation->title_ar,
                'body'=>$notifiacation->value_ar,
                'type'=>'provider',
                'order_id'=>$order->id,
            ];

            $driver_id = $order->driver_id;
            if($driver_id != null){
                pushFcmNotes($notifiy,$driver_id);
            }

            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
            }
    }

    public function reservation($id)
    {
        try{
        $order = Order::find($id);
        if(!$order){
            return response()->json(['data'=>$this->data,'message'=>$this->noDataMessage,'status'=>$this->noDataCode]);
            }
            $this->data['salons'] = new OrderDetailsResource($order);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

         }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
         }
    }

    public function pendingOrders()
    {
        try{
        $orders = Order::where('user_id',auth()->user()->id)->where('status','!=','delevired')->where('status','!=','cancelled')->get();
        $this->data = MiniOrderResource::collection($orders);
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function order(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
             $this->data = new OrderDetailsResource($order);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
            }
    }

    public function deliveredOrders()
    {
        try{
         $orders = Order::where('user_id',auth()->user()->id)->where('status','delevired')->get();

         $this->data = MiniOrderResource::collection($orders);
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }


}
