<?php

namespace App\Http\Controllers\Api\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\MiniProviderOrderResource;
use App\Http\Resources\ProviderOrderDetailsResource;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;

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
        $this->noDataMessage = 'لايوجد بيانات';
        $this->successMessage = 'تم بنجاح';
        $this->failMessage    = 'خطأ في الخادم  => ';
    }


    public function pending()
    {
            try{
            $user = auth()->user();
            $users = User::where('city_id',$user->city_id)->get()->pluck('id')->toArray();
            $orders = Order::where('driver_id',$user->id)->orwhereIn('user_id',$users)->where('status','!=','delevired')->where('status','!=','cancelled')->get();
            $this->data = MiniProviderOrderResource::collection($orders);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }

    public function details(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
             $this->data = new ProviderOrderDetailsResource($order);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
            }
    }

    public function acceptOrder(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
            $order->status = 'inprogress';
            $order->driver_id = auth()->user()->id;
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

    public function inwayOrder(OrderRequest $request)
    {
        try{
            $order = Order::find($request->order_id);
            if($order->status != 'inprogress'){
                return response()->json(['data'=>$this->data,'message'=>'غير مسموح لك بإجراء هذ العملية','status'=>$this->successCode]);
            }
            $order->status = 'inway';
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

    public function DeliverOrder(OrderRequest $request)
    {
        try{

            $order = Order::find($request->order_id);
            if($order->status != 'inway'){
                return response()->json(['data'=>$this->data,'message'=>'غير مسموح لك بإجراء هذ العملية','status'=>$this->successCode]);
            }
            $order->status = 'delevired';

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

    public function compeleted()
    {
        try{
            $user = auth()->user();
             $orders = Order::where('driver_id',$user->id)->where('status','delevired')->orWhere('status','inway')->get();
             $this->data = MiniProviderOrderResource::collection($orders);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

}
