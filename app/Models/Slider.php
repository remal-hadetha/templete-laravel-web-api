<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $guarded = ['id'];

    public function getImageUrlAttribute()
    {
        return ($this->img != null) ? asset('storage/uploads/slider/'. $this->img) : asset('media/avatars/avatar10.jpg');
    }
}
