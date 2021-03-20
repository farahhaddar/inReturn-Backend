<?php

namespace App\Models;

use User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
     protected $table="cities";
    
    public $timestamps = false;

    protected $fillable=[
        'id','name' 
    ];

       public function users()
    {
        return $this->hasMany(User::class, 'city_id', 'id');
    }

}
