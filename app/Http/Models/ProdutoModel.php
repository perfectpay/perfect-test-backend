<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoModel extends Model
{
    protected $table        = 'produto';
    protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $fillable     = [
        'nome', 'descricao', 'preco', 'blob_imagem', 'situacao'
    ];
}
