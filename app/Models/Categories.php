<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

      protected $fillable = [
        'name',
        'icon_name',
    
    ];

      public function items()
    {
        return $this->hasMany(Items::class, 'category_id', 'id');
    }

     public function itemCategoryExchange()
    {
       $this->belongsToMany(Items::class, 'ItemExchangeCatgories','category_id','item_id');

    }


}
