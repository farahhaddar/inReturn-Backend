<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phoneNb',
        'image',
        'city_id',
        'address',
        'extraInfo',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function setPasswordAttribute($password)
    {
        
        if ( !empty($password)  ){
            $this->attributes['password'] = bcrypt($password);
        }
    }

     public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id', 'id');
    }

      public function items()
    {
        return $this->hasMany(Items::class, 'user_id', 'id');
    }
    public function userWishList()
    {
       return $this->belongsToMany(User::class,'wish_lists',"user_id","item_id");

    }


}
