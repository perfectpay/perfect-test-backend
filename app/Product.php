<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'price'

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
