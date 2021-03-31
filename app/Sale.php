<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

   public function product()
    {
        return $this->hasOne('App\Product','id','product_id');
    }

    public function client()
    {
        return $this->hasOne('App\Client','id','client_id');
    }

}
