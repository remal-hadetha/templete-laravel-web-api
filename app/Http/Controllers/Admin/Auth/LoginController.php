<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;
    public function login()
    {
        return view('dashboard.pages.login');
    }

    public function Auth(AuthRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.index')->withMessage(['type'=>'success','content'=>'تم تسجيل الدخول بنجاح']);
        } 
        
        return redirect()->back()->withMessage(['type'=>'error','content'=>' تآكد من صحة البريد الإلكتروني  آو الرقم السري']);
    }

    public function logout()
    {

        Auth::guard('admin')->logout();        
        
        return redirect()->route('admin.login')->withMessage(['type'=>'success','content'=>' تم تسجيل الدخول بنجاح ']);

    }
}
