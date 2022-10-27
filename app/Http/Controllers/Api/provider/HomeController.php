<?php

namespace App\Http\Controllers\Api\provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\CancelOrderRequest;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Http\Requests\Api\Profile\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\Salon\ReservationsResource;
use App\Http\Resources\Salon\SalonReservationsDetailResource;
use App\Http\Resources\SlidersResource;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Notification;

class HomeController extends Controller
{
    //
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
            $orders = Order::where('driver_id',auth()->user()->id)->where('status','pending')->get();
            $this->data['reservations']    =  ReservationsResource::collection($orders);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function list()
    {
        try{
            $orders = Order::where('driver_id',auth()->user()->id)->where('status','!=','pending')->where('status','!=','cancelled')->get();
            $this->data['reservations']    =  ReservationsResource::collection($orders);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }



    public function categories()
    {
        try{

        $categories =  Category::all();
        $this->data['categories'] = CategoriesResource::collection($categories);
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function accept(OrderRequest $request)
    {
        try{

            $order =  Order::find($request->order_id);
            $order->status = 'inprogress';
            $order->save();

            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->driver->name . ' بقبول الطلب ' ;
            $notifiacation->value_ar = 'قام ' . $order->driver->name . ' بقبول الطلب رقم  ' . $order->id ;
            $notifiacation->order_id = $order->id;
            $notifiacation->user_id = $order->user_id;
            $notifiacation->provider_id = $order->driver_id;

            $notifiacation->type = 'user';
            $notifiacation->save();

            $notifiy = [
                'title'=>$notifiacation->title_ar,
                'body'=>$notifiacation->value_ar,
                'type'=>'user',
                'order_id'=>$order->id,
            ];

            $user_id = [$order->user_id];
            if($user_id != null){
                pushFcmNotes($notifiy,$user_id);
            }



            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function reservation(Request $request)
    {
        try{
            $order =  Order::find($request->id);
            if(!$order){
            return response()->json(['data'=>$this->data,'message'=>$this->noDataMessage,'status'=>$this->noDataCode],$this->noDataCode);
            }
            $this->data = new SalonReservationsDetailResource($order);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function finish(OrderRequest $request)
    {
        try{

            $order =  Order::find($request->order_id);
            $order->status = 'finish';
            $order->save();

            $notifiacation = new Notification();
            $notifiacation->title_ar = 'قام ' . $order->driver->name . ' تحديث حالة الطلب ' ;
            $notifiacation->value_ar = 'قام ' . $order->driver->name . ' تحديث حالة الطلب رقم  ' . $order->id ;
            $notifiacation->order_id = $order->id;
            $notifiacation->user_id = $order->user_id;
            $notifiacation->provider_id = $order->driver_id;
            $notifiacation->type = 'user';
            $notifiacation->save();

            $notifiy = [
                'title'=>$notifiacation->title_ar,
                'body'=>$notifiacation->value_ar,
                'type'=>'user',
                'order_id'=>$order->id,
            ];

            $user_id = [$order->user_id];
            if($user_id != null){
                pushFcmNotes($notifiy,$user_id);
            }


            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }


    public function cancel(CancelOrderRequest $request)
    {
        try{

            $order =  Order::find($request->order_id);
            $order->status = 'cancelled';
            $order->cancel_status = $request->reason;
            $order->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function contactus(ContactRequest $request)
    {
        try {

            $contact = new Contact();
            $contact->name = $request->name;
            $contact->message = $request->message;
            $contact->salon_id = auth()->user()->id;
            $contact->type = 'provider';
            $contact->save();
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode],$this->successCode);

        } catch (\Exception $e) {
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }

    }

}
