<?php

namespace App\Http\Resources\Salon;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class SalonReservationsDetailResource extends JsonResource
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
            'user'=>new UserResource($this->user),
            'date'=>$this->date,
            'work_start'=>$this->from_time,
            'work_end'=>$this->to_time,
            'status'=>$this->status,
            'services'=>ServiceResource::collection($this->services)
        ];
    }
}
