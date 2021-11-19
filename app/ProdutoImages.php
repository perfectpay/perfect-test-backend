<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoImages extends Model
{
    protected $table = "produto_images";
    protected $fillable= [
        'produto_id',
        'path',
    ];
}
