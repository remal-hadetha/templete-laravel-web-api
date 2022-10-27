<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\ApiMasterRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class CreateOrderRequest extends ApiMasterRequest
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
            'services'   =>'required|array',
            'services.*' =>'required|exists:services,id',
            'images'     =>'nullable|array',
            'images.*'   =>'nullable|image',
            'total'      =>'required',
            'date'       =>'required',
            'from_time'  =>'required',
            'to_time'    =>'required',
            'description'=>'nullable',
            'salon_id'   =>'required|exists:users,id,type,provider',
            'payment_type'=>'required',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        if(Arr::exists($data,'services')){
            $data['services'] = json_decode($data['services'],true);
        }
        $this->getInputSource()->replace($data);
        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }

}
