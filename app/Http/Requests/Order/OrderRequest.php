<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id'=>'required',
            'delivery_price'=>'required',
            'enable_tax'=>'required',
            'tax'=>'required_if:enable_tax,1',
            'discount'=>'required',
            'price_persentage_discount'=>'required_if:discount,persentage',
            'price_money_discount'=>'required_if:discount,money',
            'date'=>'required|date',
            'time'=>'required',
            'items'=>'required|array',
            'items.*'=>'required',
            'quantity'=>'required|array',
            'quantity.*'=>'required',
        ];
    }
}
