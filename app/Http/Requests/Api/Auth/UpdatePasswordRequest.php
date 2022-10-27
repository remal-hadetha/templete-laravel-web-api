<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use Facade\FlareClient\Api;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends ApiMasterRequest
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
            'password'=>'required|confirmed|min:4'
        ];
    }
}
