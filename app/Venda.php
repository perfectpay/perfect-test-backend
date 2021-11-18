<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = "venda";
    protected $fillable= [
        'data',
        'quantidade',
        'desconto',
        'status',
        'cliente_id',
        'produto_id',
    ];

    /**
     * Retorna todos os produtos da venda.
     */
    public function produtosVenda(){
        return $this->hasOne(Produto::class);
    }

    /**
     * Retorna todos os produtos da venda.
     */
    public function clientesVenda(){
        return $this->belongsTo(Cliente::class);
    }
}
