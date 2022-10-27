<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name_ar,
            'quantity'=>$this->pivot->quantity,
            'price'=>$this->price,
            'image'=> $this->ImageUrl,
            'category_id'=>$this->category->id,
            'category_name'=>$this->category->name_ar
        ];
    }
}
