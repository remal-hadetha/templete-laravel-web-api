<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            'name' =>$this->name,
            'email'=>$this->email,
            'token'=>$this->token->jwt,
            'phone'=>$this->phone,
            'image'=>$this->ImageUrl,
            'address'=>$this->address,
            'total_review'=>$this->total_review == null ? 0 : $this->total_review,
            'available'=>$this->available == '1' ? true:false,

        ];
    }
}
