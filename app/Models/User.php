<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
    protected $guarded = ['id'];
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function token()
    {
        return $this->hasOne(Token::class);
    }

    public function getImageUrlAttribute()
    {

        return ($this->img != null) ? asset('storage/uploads/users/' . $this->img) : asset('media/avatars/avatar10.jpg');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }

    public function providerOrders()
    {
        return $this->hasMany(Order::class,'driver_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class,'salon_id');
    }

    public function works()
    {
        return $this->hasMany(Work::class,'salon_id');
    }

    public function scopeGetByDistance($q,$lat, $lng)
    {
        $q->select(\DB::raw("*,
        (6378.10 * ACOS(COS(RADIANS($lat))
        * COS(RADIANS(lat))
        * COS(RADIANS($lng) - RADIANS(lng))
        + SIN(RADIANS($lat))
        * SIN(RADIANS(lat)))) AS distance"))
        ->having('distance', '<=', 40000)
        ->orderBy('distance', 'asc');

    }

    public function userReviews()
    {
        return $this->hasMany(Review::class, 'from_user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'to_user_id');
    }


    public function contacts()
    {
        return $this->hasMany(Contact::class, 'user_id', 'id');
    }

    public function salonContacts()
    {
        return $this->hasMany(Contact::class, 'salon_id', 'id');
    }


    public function favs()
    {
        return $this->belongsToMany(User::class, 'wish_lists', 'user_id','salon_id');
    }


}
