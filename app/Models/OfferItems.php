<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferItems extends Model
{
    use HasFactory;
      protected $fillable = [
        'item_id',
        'item_trade_with_id',

    ];
}
