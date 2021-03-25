<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

     public $timestamps = false;

     protected $fillable = [
        'item_id',
        'status',
        
    ];
       public function itemOffers()
    {
       $this->belongsToMany(Items::class, 'WishList', 'item_id', 'item_trade_with_id');

    }
}
