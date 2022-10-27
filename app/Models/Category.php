<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = ['id'];

    public function maincategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        return ($this->img != null) ? asset('storage/uploads/categories/' . $this->img) : asset('media/avatars/avatar10.jpg');
    }

    public function getBackImageUrlAttribute()
    {
        return ($this->img != null) ? asset('storage/uploads/categories/' . $this->back_img) : asset('media/avatars/avatar10.jpg');
    }


    public function salons()
    {
        return $this->hasMany(User::class, 'category_id', 'id');
    }


}
