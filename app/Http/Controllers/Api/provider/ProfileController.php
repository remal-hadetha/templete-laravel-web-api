<?php

namespace App\Http\Controllers\Api\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use JWTAuth;

use App\Http\Resources\UserResource;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ActiveRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ForgetRequest;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;
use App\Http\Requests\Api\Auth\ProviderRegisterRequest;
use App\Http\Requests\Api\Profile\DeleteNotificationRequest;
use App\Models\User;
use App\Models\Token;
use App\Models\Order;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;
use App\Http\Requests\Api\Service\StoreServiceRequest;
use App\Http\Requests\Api\Service\StoreWorkRequest;
use App\Http\Requests\Api\Service\DeleteServiceRequest;
use App\Http\Requests\Api\Service\DeleteWorkRequest;
use App\Http\Requests\Api\Service\StoreTimeRequest;
use App\Http\Requests\Api\Service\StoreAvailableRequest;

use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use App\Http\Requests\Api\Profile\UpdatePassowrd;
use App\Http\Resources\Salon\ServiceResource;
use App\Http\Resources\Salon\WorkResource;
use App\Http\Resources\Salon\ProfileResource;
use App\Models\Service;
use App\Models\Work;


class ProfileController extends Controller
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
        $this->noDataMessage = 'لايوجد بيانات';
        $this->successMessage = 'تم بنجاح';
        $this->failMessage    = 'خطأ في الخادم  => ';
    }

    public function profile()
    {
        try{
        $authUser = auth()->user();
        $this->data = new ProfileResource($authUser);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function Logout()
    {
        $user_token = auth()->user()->token;
        $user_token->is_logged_in = 'false';
        $user_token->fcm = '';
        $user_token->update();
        $this->data['data'] = null;
        $this->data['status'] = 200;
        $this->data['message'] = "";
        return response()->json($this->data, 200);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        if($request->name){
            $user->name = $request->name;
        }

        if($request->email){
            $oldEmail  = User::where('email',$request->email)->first();
            if($oldEmail){
             if($oldEmail->email == auth()->user()->email){

             }else{
                $this->data['data'] = "";
                $this->data['status'] = "ok";
                $this->data['message'] = "البريد الإلكتروني مستخدم من قبل ";
                return response()->json($this->data, 401);
             }
            }else{
                $user->email = $request->email;

            }
        }
        if($request->phone){
            $oldPhone  = User::where('phone',$request->phone)->first();
            if($oldPhone){
                if($oldPhone->phone == auth()->user()->phone){

                }else{
                $this->data['data'] = "";
                $this->data['status'] = "ok";
                $this->data['message'] = "الهاتف مستخدم من قبل ";
                return response()->json($this->data, 401);
                 }
            }else{
                $user->phone = $request->phone;
            }
        }

        if($request->password){
            $user->password = $request->password;
        }

        if($request->bio){
            $user->bio = $request->bio;
        }

        if($request->lat && $request->lng){
            $user->lat = $request->lat;
            $user->lng = $request->lng;
        }

        if($request->address){
            $user->address = $request->address;
        }


        if($request->image){
            $image_name = time(). $request->image->getClientOriginalName();
            $request->image->move(storage_path('app/public/uploads/users/'),$image_name);
            $user->img = $image_name;
        }

        if($request->category_id){
            $user->category_id = $request->category_id;
        }

        $user->save();
        $this->data = new UserResource($user);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
    }

    public function updatePassword(UpdatePassowrd $request)
    {
        try{
            $old_password = $request->old_password;
            $authUser = auth()->user();
            if(\Hash::check($old_password, $authUser->password)){
                $authUser->password = $request->password;
                $authUser->save();
                $this->data = new UserResource($authUser);
                return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
            }

            $this->data['data'] = "";
            $this->data['status'] = 401;
            $this->data['message'] = "تأكد من كلمة المرور القديمة";
            return response()->json($this->data, 401);


        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function addService(StoreServiceRequest $request )
    {
        try{

        $service = new Service();
        $service->name = $request->name;
        $service->time = $request->time;
        $service->price = $request->price;
        $image_name = time(). $request->image->getClientOriginalName();
        $request->image->move(storage_path('app/public/uploads/services/'),$image_name);
        $service->image = $image_name;
        $service->salon_id = auth()->user()->id;
        $service->save();
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function myServices()
    {
        try{
        $services = Service::where('salon_id',auth()->user()->id)->get();
        $this->data['services'] = ServiceResource::collection($services);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }

    public function deleteService(DeleteServiceRequest $request)
    {
        try{
        $service = Service::find($request->id);
        $service->delete();
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
        }
    }



    public function addWork(StoreWorkRequest $request)
    {
        try {
        $work = new Work();
        $image_name = time(). $request->image->getClientOriginalName();
        $request->image->move(storage_path('app/public/uploads/works/'),$image_name);
        $work->image = $image_name;
        $work->salon_id = auth()->user()->id;
        $work->save();
        $this->data['work'] = new WorkResource($work);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function myWorks()
    {
        try{
        $works = Work::where('salon_id',auth()->user()->id)->get();
        $this->data['works'] = WorkResource ::collection($works);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function deleteWork(DeleteWorkRequest $request)
    {
        try{
        $work = Work::find($request->id);
        $work->delete();
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }


    public function updateTime(StoreTimeRequest $request)
    {
        try{
            $salon = auth()->user();
            $salon->work_start = $request->work_start;
            $salon->work_end   = $request->work_end;
            $salon->save();
           return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function toggleAvailable(StoreAvailableRequest $request)
    {
        try{
            $salon = auth()->user();
            $salon->available = $request->available;
            $salon->save();
            $this->data['available'] = $salon->available;
           return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }


    public function notification()
    {
        try{
            $authUser = auth()->user();
            $usersId = User::where('city_id',$authUser->city_id)->pluck('id')->toArray();
            $userOrders = Order::whereIn('user_id',$usersId)->where('driver_id',null)->orWhere('driver_id',$authUser->id)->pluck('id')->toArray();
            $this->data = Notification::whereIn('order_id',$userOrders)->where('type','provider')->get();
            $this->data = NotificationResource::collection($this->data);
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function deleteNotification(DeleteNotificationRequest $request)
    {
        try{
            foreach ($request->notifications as $id) {
                $notification = Notification::find($id);
                $notification->delete();
            }
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

}
