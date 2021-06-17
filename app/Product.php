<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'name',
        'brief',
        'description',
        'price',
        'image'

    ];

            protected $dates = [
        'deleted_at',
    ];
    public function category()
    {
        return $this->belongsTo('App\Category');
        //Relationships do eloquent (Inverse Of The Relation)
    }
}
