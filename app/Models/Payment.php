<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = ['id'];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }


    public function coupon()
    {
        return $this->belongsTo(User::class, 'coupon_id', 'id');
    }

}
