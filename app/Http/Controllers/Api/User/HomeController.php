<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\City;
use App\Models\Contact;
use App\Models\User;
use App\Models\Work;

use App\Http\Resources\CategoriesResource;
use App\Http\Resources\SlidersResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\User\SalonResource;
use App\Http\Resources\User\SalonDetailResource;
use App\Http\Requests\Api\Product\ProductRequest;
use App\Http\Requests\Api\Product\ProductsRequest;
use App\Http\Requests\Api\Profile\ContactRequest;
use App\Http\Requests\Api\Cart\ProductSearch;
use App\Http\Resources\Salon\ServiceResource;
use App\Http\Resources\Salon\WorkResource;
use App\Http\Resources\User\ReviewResource;
use App\Models\Service;

class HomeController extends Controller
{
    private $user;
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

    public function index()
    {
        try{
               $categories =  Category::all();
               $sliders    = Slider::all();
               $this->data['categories'] =  CategoriesResource::collection($categories);
               $this->data['sliders']    =  SlidersResource::collection($sliders);
               $near = User::where('type','provider')->take(3)->get();
               if(auth()->user()){
                 $near = User::where('type','provider')->GetByDistance(auth()->user()->lat,auth()->user()->lng)->take(3)->get();
                }
               $most = User::where('type','provider')->withCount('providerOrders as number')->orderBy('number', 'asc')->take(3)->get();
               $this->data['salons']['near'] = SalonResource::collection($near);
               $this->data['salons']['most'] = SalonResource::collection($most);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function allNear()
    {
        try{
            $near = User::where('type','provider')->get();
            if(auth()->user()){
             $near = User::where('type','provider')->GetByDistance(auth()->user()->lat,auth()->user()->lng)->get();
            }
            $this->data['salons'] = SalonResource::collection($near);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function allMost()
    {
        try{
            $most = User::where('type','provider')->withCount('providerOrders as number')->orderBy('number', 'asc')->take(3)->get();
            $this->data['salons'] = SalonResource::collection($most);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function reviews($id)
    {
        try{
            $salon = User::find($id);
            if(!$salon){
                return response()->json(['data'=>$this->data,'message'=>$this->noDataMessage,'status'=>$this->noDataCode],$this->noDataCode);
            }

            $this->data['reviews'] = ReviewResource::collection($salon->reviews);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function getByCategoryID($id)
    {
        try{
            $category = Category::find($id);
            if(!$category){
              return response()->json(['data'=>$this->data,'message'=>$this->noDataMessage,'status'=>$this->noDataCode],$this->noDataCode);
             }
             $salons = User::where('type','provider')->where('category_id',$category->id)->get();
             $this->data['salons'] = SalonResource::collection($salons);
             return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

             }catch (\Exception $e){
                 return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
             }

    }

    public function products(ProductsRequest $request)
    {
        try{
            $products =  Product::where('category_id',$request->category_id)->get();
            $this->data =  ProductsResource::collection($products);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);
     }catch (\Exception $e){
         return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
     }
    }

    public function product(ProductRequest $request)
    {
        try{
            $products =  Product::find($request->product_id);
            $this->data = new ProductsResource($products);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }



    public function salon_details($id)
    {
        try{
       $salon = User::where('type','provider')->where('id',$id)->first();
       if(!$salon){
         return response()->json(['data'=>$this->data,'message'=>$this->noDataMessage,'status'=>$this->noDataCode],$this->noDataCode);
        }

        $this->data['salon'] = new SalonDetailResource($salon);
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }

    }


    public function cities()
    {
        try{
            $cities =  City::all();
            $this->data = CityResource::collection($cities);
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function contact()
    {
        try{
          $this->data['phone']    =  SETTING_VALUE('MOBILE');
          $this->data['whatsapp'] =  SETTING_VALUE('WhatsApp');
          $this->data['email']    =  SETTING_VALUE('FORMAL_EMAIL');
          $this->data['facebook'] =  SETTING_VALUE('FACEBOOK_URL');
          $this->data['twitter']  =  SETTING_VALUE('TWITTER_URL');
          $this->data['instgram'] =  SETTING_VALUE('INSTAGRAM_URL');
         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function about()
    {
        try{
          $this->data    =   SETTING_VALUE('ABOUT_AR');

         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function policy()
    {
        try{
          $this->data    =  SETTING_VALUE('PRIVACY_POLICY_AR');

         return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function contactus(ContactRequest $request)
    {
        try {

            $contact = new Contact();
            $contact->name = $request->name;
            $contact->message = $request->message;
            $contact->user_id = auth()->user()->id;
            $contact->type = 'user';
            $contact->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

        } catch (\Exception $e) {
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }

    }

    public function SalonWorks($id)
    {
        try{
            $salon = User::find($id);
            $works = Work::where('salon_id',$id)->get();
            if(!$salon){
                return response()->json(['data'=>$this->data,'message'=>$this->noDataMessage,'status'=>$this->noDataCode],$this->noDataCode);
            }
            $this->data['works'] = WorkResource ::collection($works);
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function SalonServices($id)
    {
        try{
        $salon = User::find($id);
        $services = Service::where('salon_id',$id)->get();
        if(!$salon){
            return response()->json(['data'=>$this->data,'message'=>$this->noDataMessage,'status'=>$this->noDataCode],$this->noDataCode);
        }
        $this->data['services'] = ServiceResource ::collection($services);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }


    public function search(ProductSearch $request)
    {
        try{
        $salons = User::where('type','provider')->where('name','like','%'.$request->key.'%')->get();
        $this->data['salons'] = SalonResource::collection($salons);
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }

    }


}
