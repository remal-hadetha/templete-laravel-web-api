<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests\Api\Profile\DeleteNotificationRequest;

use App\Http\Resources\UserResource;
use App\Http\Resources\NotificationResource;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ActiveRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ForgetRequest;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use App\Http\Requests\Api\Auth\ProviderRegisterRequest;
use App\Http\Requests\Api\Profile\RateRequest;
use App\Http\Requests\Api\Profile\UpdatePassowrd;
use App\Http\Resources\User\SalonDetailResource;
use App\Models\User;
use App\Models\Token;
use App\Models\Notification;
use App\Models\Review;
use App\Http\Resources\User\SalonResource;
use App\Models\WishList;

class ProfileController extends Controller
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
        $this->successMessage = 'تم بنجاح';
        $this->noDataMessage = 'لايوجد بيانات';
        $this->failMessage    = ' خطآ في الخادم  => ';
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

    public function profile()
    {
        $user = auth()->user();

        $this->data = new UserResource($user);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
    }


    public function updateProfile(UpdateProfileRequest $request)
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

        if($request->city_id){
            $user->city_id = $request->city_id;
        }

        if($request->image){
            $image_name = time(). $request->image->getClientOriginalName();
            $request->image->move(storage_path('app/public/uploads/users/'),$image_name);
            $user->img = $image_name;
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
            $this->data['status'] = "ok";
            $this->data['message'] = "تأكد من كلمة المرور القديمة";
            return response()->json($this->data, 401);


        }catch (Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }


    public function notification()
    {
        try{
            $authUser = auth()->user();
            $this->data =  Notification::orWhere('user_id',$authUser->id)->get();
            $this->data = NotificationResource::collection($this->data);
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function Rate(RateRequest $request)
    {
       $user      =  auth()->user();
       $salon_id = $request->salon_id;
       $rate      = $request->rate;

       $salon = User::where('id',$salon_id)->where('type','provider')->first();
       if(!$salon){
        return response()->json(['data'=>$this->data, 'message'=>'هذا الصالون غير موجود','status'=>$this->noDataCode],$this->noDataCode);
       }

       $review = new Review();
       $review->from_user_id = $user->id;
       $review->to_user_id   = $salon->id;
       $review->review	     = $rate;
       $review->comment      = $request->comment;
       $review->save();
       if($salon->total_rate == null){
        $salon->total_rate = $request->rate;
       }else{
        $totalReviews = Review::where('to_user_id',$salon->id)->sum('review');
        $salon->total_rate = $totalReviews / 5;
       }

       $notifiacation = new Notification();
       $notifiacation->title_ar = 'قام ' . $user->name . '  بتقيمك ' ;
       $notifiacation->value_ar = 'قام ' . $user->name . '  بتقيمك بقيمة  ' . $review->review ;
       $notifiacation->user_id = $user->id;
       $notifiacation->provider_id = $salon_id;

       $notifiacation->type = 'provider';
       $notifiacation->save();

       $notifiy = [
           'title'=>$notifiacation->title_ar,
           'body'=>$notifiacation->value_ar,
           'type'=>'provider',
       ];

       $user_id = [$user->id];
       if($user_id != null){
           pushFcmNotes($notifiy,$user_id);
       }


        if($salon->save()){
            return response()->json(['data'=>$this->data, 'message'=>'تم تسجيل التقيم بنجاح','status'=>$this->successCode]);

        }else{
            return response()->json(['data'=>$this->data, 'message'=>'حاول مره أخري','status'=>$this->successCode]);
        }

    }

    public function fav()
    {
        try{
            $salons = auth()->user()->favs;
            $this->data['salons'] = SalonResource::collection($salons);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
            }

    }

    public function toggleFav($id)
    {
        try{

            $salon = User::where('id',$id)->where('type','provider')->first();
            if(!$salon){
                return response()->json(['data'=>$this->data, 'message'=>'هذا الصالون غير موجود','status'=>$this->noDataCode,$this->noDataCode]);
            }

            $wishlist = WishList::where('user_id',auth()->user()->id)->where('salon_id',$salon->id)->first();
            if($wishlist){
                $wishlist->delete();
            }else{
                $newWishList = new WishList();
                $newWishList->user_id = auth()->user()->id;
                $newWishList->salon_id = $salon->id;
                $newWishList->save();
            }
            $this->data['salon'] = new SalonDetailResource($salon);
            return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);

            }catch (\Exception $e){
                return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode],$this->serverErrorCode);
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
