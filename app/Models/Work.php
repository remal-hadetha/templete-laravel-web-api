<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = ['id'];

    public function getImageUrlAttribute()
    {
        return ($this->image != null) ? asset('storage/uploads/works/'. $this->image) : asset('media/avatars/avatar10.jpg');
    }


    public function salon()
    {
        return $this->belongsTo(User::class, 'salon_id', 'id');
    }


}
