<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot('quantity');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function salon()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'order_services', 'order_id', 'service_id');
    }


    public function servicesCount()
    {
        return $this->belongsToMany(Service::class, 'order_services', 'order_id', 'service_id')->selectRaw('count(services.id) as aggregate')->groupBy('order_id');
    }

    public function getServicesCountAttribute()
    {
        if ( ! array_key_exists('servicesCount', $this->relations)) $this->load('servicesCount');

        $related = $this->getRelation('servicesCount')->first();

        return ($related) ? $related->aggregate : 0;
    }

    public function images()
    {
        return $this->hasMany(ImageOrder::class, 'order_id', 'id');
    }


}
