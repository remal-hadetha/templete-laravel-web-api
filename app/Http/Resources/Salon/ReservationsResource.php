<?php

namespace App\Http\Resources\Salon;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationsResource extends JsonResource
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
            'status'=>$this->status
        ];
    }
}
