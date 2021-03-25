<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $dateFormat = 'd.m.Y';

    protected $table = 'items'; 

    protected $fillable = [
        'name',
        'details',
        'date',
        'user_id',
        'category_id',

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
       return $this->belongsToMany(Categories::class,'item_exchange_catgories',"item_id","category_id");

    }
    public function itemWishList()
    {
       return $this->belongsToMany(User::class,'wish_lists',"item_id","user_id");

    }

    public function offers()
    {
      return   $this->belongsToMany(Offer::class,'offer_items','item_id','item_trade_with_id');

    }

    public function images()
    {
        return $this->hasMany(ItemImages::class, 'item_id', 'id');
    }

}
