<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];

    //
    public function getImageUrlAttribute()
    {
        return ($this->image != null) ? asset('storage/uploads/services/'. $this->image) : asset('media/avatars/avatar10.jpg');
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_services', 'service_id', 'order_id');
    }


    public function salon()
    {
        return $this->belongsTo(User::class, 'salon_id', 'id');
    }


}
