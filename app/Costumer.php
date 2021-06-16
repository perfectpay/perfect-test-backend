<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Costumer extends Model
{
     use SoftDeletes;
     protected $fillable = [
        'name',
        'email',
        'cpf',

    ];
     protected $dates = [
        'deleted_at',
    ];
}
