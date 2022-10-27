<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

use App\Http\Resources\UserResource;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ActiveRequest;
use App\Http\Requests\Api\Auth\ApplyRequset;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ForgetRequest;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;

use App\Models\User;
use App\Models\Token;

class LoginController extends Controller
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
        $this->noDataMessage = 'لايوجد بيانات';
        $this->successMessage = 'تم بنجاح';
        $this->failMessage    = 'خطأ في الخادم  => ';
    }

    public function register(RegisterRequest $request)
    {
        $request_data = $request->except(['image', 'password_confirmation','device_type','fcm_token','city']);
        $code = random_int(1111, 9999);
        // $request_data['mobile_code'] = random_int(1111, 9999);
        $request_data['mobile_code'] = $code;
        send_sms($request->mobile , 'your activation code is' . $code);


        $request_data['type'] = 'user';

        if ($request->image) {
            $image_name = time(). $request['image']->getClientOriginalName();
            $request['image']->move(storage_path('app/public/uploads/users/'),$image_name);
            $request['img'] = $image_name;
        }

       if ($request->lat) {
           $request_data['lat'] = $request->lat;
       }
       if ($request->lng) {
           $request_data['lng']  = $request->lng;
       }

        $user = User::create($request_data);

        if ($user) {
            $token = new Token();
            $token->user_id = $user->id;
            $token->fcm = $request->fcm_token;
            $token->device_type = $request->header('os');
            $token->jwt = JWTAuth::fromUser($user);
            $token->is_logged_in = 'false';
            $token->ip = $request->ip();
            $token->save();
        }
        $this->data = $user->mobile_code;
        return response()->json(['data'=>$this->data,'message'=>$this->successMessage,'status'=>$this->successCode]);
    }


    public function login(LoginRequest $request)
    {
        $perms['phone'] = $request->mobile;
        $perms['password'] = $request->password;
        $perms['type']  = 'user';
        //$perms['email']  = $request->mobile;
        if (!$token = JWTAuth::attempt($perms)) {
            $this->data['data'] = "";
            $this->data['status'] = 401;
            $this->data['message'] = trans('auth.failed');
            return response()->json($this->data,401);
        }
        $user = auth()->user();

        $old_token = Token::where('user_id',$user->id)->first();

        if (!$old_token) {
            $token = new Token();
            $token->user_id = $user->id;
            $token->jwt = JWTAuth::fromUser($user);
            $token->ip = $request->ip();
            $token->save();
        }

        $logged_user = auth()->user();
        if ($request->lng && $request->lat) {
            $logged_user->lat = $request->lat;
            $logged_user->lng = $request->lng;
        }
        $logged_user->update();
        $logged_user_token = $logged_user->token;
        $logged_user_token->jwt = $token;
        $logged_user_token->is_logged_in = "true";
        if($request->fcm_token){
            $logged_user_token->fcm = $request->fcm_token;
        }
        if($request->header('os')){
            $logged_user_token->device_type = $request->header('os');
        }
        if($request->ip()){
            $logged_user_token->ip =$request->ip() ;
        }
        $logged_user_token->update();
        $this->data = new UserResource($logged_user);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);

    }

    public function active(ActiveRequest $request)
    {
        try{
            $code = $request->code;
            $user = User::where(['phone'=>$request->phone,'mobile_code'=>$code])->first();
            if(!$user){
                $this->data['data'] = "";
                $this->data['status'] = 401;
                $this->data['message'] = trans('auth.failed');
                return response()->json($this->data,401);
            }
            $user->mobile_code = '';
            $user->active = '1';
            $user->save();
            $this->data = new UserResource($user);
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }

    }

    public function forget(ForgetRequest $request)
    {
        try{
            $phone = $request->mobile;
            $user = User::where('phone',$phone)->first();
            $code = random_int(1111, 9999);
            send_sms($request->mobile , 'your activation code is' . $code);
            $user->mobile_code =$code ;
            $user->active = '0';
            $user->save();
            $old_token = Token::where('user_id',$user->id)->first();

            if (!$old_token) {
                $token = new Token();
                $token->user_id = $user->id;
                $token->ip = $request->ip();
                $token->save();
            }
            $this->data = $user->mobile_code;
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function sendCode(ForgetRequest $request)
    {
        try{
            $phone = $request->mobile;
            $user = User::where('phone',$phone)->first();
            $code  = random_int(1111, 9999);
            $user->mobile_code = $code;
            send_sms($request->mobile , 'your activation code is' . $code);


            $user->save();
            $old_token = Token::where('user_id',$user->id)->first();

            if (!$old_token) {
                $token = new Token();
                $token->user_id = $user->id;
                $token->ip = $request->ip();
                $token->save();
            }
            $this->data = $user->mobile_code;
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request){
        try{
            $user = auth()->user();
            $user->password = $request->password;
            $user->mobile_code = '';
            $user->active = '1';
            $user->save();

            $old_token = Token::where('user_id',$user->id)->first();

            if (!$old_token) {
                $token = new Token();
                $token->user_id = $user->id;
                $token->ip = $request->ip();
                $token->save();
            }

            $this->data = new UserResource($user);
            return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

    public function Logout()
    {
        $user_token = $this->user->token;
        $user_token->is_logged_in = 'false';
        $user_token->fcm = '';

        $user_token->update();
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
    }



    public function apply(ApplyRequset $request)
    {
        try{

        $user = User::where(['phone'=>$request->mobile,'mobile_code'=>$request->code])->first();
        $this->data = new UserResource($user);
        return response()->json(['data'=>$this->data, 'message'=>$this->successMessage,'status'=>$this->successCode]);
        }catch (\Exception $e){
            return response()->json(['data'=>$this->data, 'message'=>$this->failMessage . $e,'status'=>$this->serverErrorCode]);
        }
    }

}
