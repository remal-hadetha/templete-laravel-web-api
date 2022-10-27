<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiMasterRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends ApiMasterRequest
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
            //
            'email'   =>'nullable|unique:users,email,'.auth()->user()->id,
            'phone'   =>'nullable|unique:users,phone,'.auth()->user()->id,
            'city_id' =>'nullable|exists:cities,id',

        ];
    }
}
