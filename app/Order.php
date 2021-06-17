<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
     use SoftDeletes;
     protected $fillable = [
        'costumer_id',
        'product_id',
        'quantity',
        'discount',
        'status',
        'order_date',

    ];
     protected $dates = [
        
        'deleted_at',
    ];

     public function user()
    {
        return $this->hasOne('App\User');
        //Relationships do eloquent
    }

         public function product()
    {
        return $this->hasOne('App\Product');
        //Relationships do eloquent. Como esta nos requisitos que cada ordem teria um produto apenas, utilizeri o hasOne ao inves do HasMany
    }
}
