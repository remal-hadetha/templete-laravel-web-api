<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $guarded = ['id'];



    public function reviewer()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    public function salon()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }

}
