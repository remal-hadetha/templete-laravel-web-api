<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\SalonResource;
class MiniOrderResource extends JsonResource
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
            'salon'=>new SalonResource($this->salon),
            'date'=>$this->date,
            'start_time'=>$this->from_time,
            'end_time'=>$this->to_time,
            'total'=>$this->sub_total,
            'status'=>$this->status
        ];
    }
}
