<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'desc'=>$this->desc_ar,
            'image'=> $this->ImageUrl,
            'price'=>$this->price,
            'category_id'=>$this->category->id,
            'category_name'=>$this->category->name_ar
        ];
    }
}
