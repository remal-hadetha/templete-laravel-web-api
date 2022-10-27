<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'lat'=>$this->lat,
            'long'=>$this->long,
            'type'=>$this->type,
            'number'=>$this->number,
            'near_place'=>$this->near_place,
            'details'=>$this->desc
        ];
    }
}
