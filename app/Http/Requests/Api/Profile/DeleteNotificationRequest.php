<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiMasterRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class DeleteNotificationRequest extends ApiMasterRequest
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
            'notifications'=>'required|array',
            'notifications.*'=>'required|exists:notifications,id'
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        if(Arr::exists($data,'notifications')){
            $data['notifications'] = json_decode($data['notifications'],true);
        }
        $this->getInputSource()->replace($data);
        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
