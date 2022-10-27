<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiMasterRequest;
use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends ApiMasterRequest
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
            'salon_id'=>'required|exists:users,id',
            'rate'=>'required|numeric',
            'comment'=>'required'
        ];
    }
}
