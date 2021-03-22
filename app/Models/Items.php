<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $dateFormat = 'd.m.Y';
    
     protected $fillable = [
        'name',
        'details',
        'user_id',
        'category_id'


    ];

     public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

      public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

     public function categoryExchange()
    {
       $this->belongsToMany(Categories::class, 'ItemExchangeCatgories', 'item_id', 'category_id');

    }

      public function itemWishList()
    {
       $this->belongsToMany(User::class, 'WishList', 'item_id', 'user_id');

    }

      public function offers()
    {
       $this->belongsToMany(Offer::class, 'WishList', 'item_id', 'item_trade_with_id');

    }

       public function images()
    {
        return $this->hasMany(ItemImages::class, 'item_id', 'id');
    }


}
