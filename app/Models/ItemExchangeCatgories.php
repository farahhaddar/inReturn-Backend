<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemExchangeCatgories extends Model
{
    use HasFactory;
    
     public $timestamps = false;

    protected $table = "item_exchange_catgories";

    protected $fillable = [
        'item_id',
        'category_id',
    ];

}
