<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\SalonResource;
use App\Http\Resources\Salon\ServiceResource;

class OrderDetailsResource extends JsonResource
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
            'salon'=> $this->driver_id ?  new SalonResource(\App\Models\User::find($this->driver_id)) : $this->driver_id,
            'total'=>$this->sub_total,
            'services'=> ServiceResource::collection($this->services),
            'start_time'=>$this->from_time,
            'end_time'=>$this->to_time,
            'date'=>$this->date,
            'payment_type'=>$this->payment_type
        ];
    }
}
