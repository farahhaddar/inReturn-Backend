<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImages extends Model
{
    use HasFactory;
    
     public $timestamps = false;

     protected $fillable = [
        'image',
        'item_id',

    ];

       public function items()
    {
        return $this->belongsTo(Items::class, 'item_id', 'id');
    }
}
