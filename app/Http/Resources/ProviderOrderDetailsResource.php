<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderOrderDetailsResource extends JsonResource
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
            'status'=>$this->status,
            'user'=> $this->user_id ?  new UserResource(\App\Models\User::find($this->user_id)) : $this->user_id,
            'products'=>OrderProductResource::collection($this->products),
            'address'=>$this->address_id ? new AddressResource(\App\Models\Address::find($this->address_id)) : $this->address_id,
            'sub_total'=>$this->sub_total,
            'delivery_price'=>10,
            'tax'=>75,
            'total'=>$this->total
        ];
    }
}
