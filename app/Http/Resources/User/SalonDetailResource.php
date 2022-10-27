<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Salon\ServiceResource;
use App\Http\Resources\Salon\WorkResource;
use JWTAuth;
class SalonDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        try{
            $token = JWTAuth::getToken();
            $user =  JWTAuth::parseToken()->toUser();
        }catch(\Exception $e){
                $user = null;
        }
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>$this->ImageURL,
            'total_review'=>$this->total_rate,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'work_start'=>$this->work_start,
            'work_end'=>$this->work_end,
            'fav'=>$user ? checkFavourite($user->id,$this->id) : false,
            'bio'=>$this->bio,
            'services'=> count($this->services) == 0 ? null :ServiceResource::collection($this->services),
            'works'=>count($this->works) == 0  ? null : WorkResource::collection($this->works),
            'reviews'=>count($this->reviews) == 0 ? null : ReviewResource::collection($this->reviews)
        ];
    }
}
