<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiMasterRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile'=>'Required|exists:users,phone',
            'password'=>'Required'
        ];
    }

    public function messages()
    {
      return  [
            'mobile.required'=>'Please Enter Your Phone Number or Email',
            'password.required'=>'Please Enter Your passwrod'
        ];
    }
}
