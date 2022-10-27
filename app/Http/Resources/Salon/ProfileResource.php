<?php

namespace App\Http\Resources\Salon;
use  App\Http\Resources\CategoriesResource;
use App\Http\Resources\User\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name'=>$this->name,
            'image'=>$this->ImageURL,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'address'=>$this->address,
            'work_start'=>$this->work_start,
            'work_end'=>$this->work_end,
            'category'=>new CategoriesResource($this->category),
            'services'=>count($this->services) == 0 ? null :  ServiceResource::collection($this->services),
            'works'=>count($this->works) == 0 ? null : WorkResource::collection($this->works),
            'reviews'=>count($this->reviews) == 0 ? null : ReviewResource::collection($this->reviews)

        ];
    }
}
