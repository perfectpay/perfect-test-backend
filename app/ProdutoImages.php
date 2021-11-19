<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoImages extends Model
{
    protected $table = "visitas_arquivos";
    protected $fillable= [
        'produto_id',
        'path',
    ];
}
