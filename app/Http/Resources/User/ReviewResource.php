<?php

namespace App\Http\Resources\User;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'content'=>$this->comment,
            'reviewer'=> $this->reviewer ?  new UserResource($this->reviewer) :null ,
        ];
    }
}
