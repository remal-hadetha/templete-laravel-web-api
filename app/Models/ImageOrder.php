<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageOrder extends Model
{

    public function getImageUrlAttribute()
    {
        return ($this->image != null) ? asset('storage/uploads/orders/' . $this->img) : asset('media/avatars/avatar10.jpg');
    }
}
