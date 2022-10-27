<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MiniProviderOrderResource extends JsonResource
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
            'username'=>$this->user_id ?  $this->user->name : $this->user_id, 
            'total'=>$this->total,
            'product_count'=>$this->products->count()
        ];
        
    }
}
