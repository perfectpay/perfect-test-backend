<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";
    protected $fillable= [
        'name',
        'email',
        'cpf',
    ];

    /**
     * Retorna todas as vendas do cliente.
     */
    public function vendasCliente(){
        return $this->hasMany(Venda::class);
    }

    /**
     * Retorna todos os produtos comprados pelo cliente.
     */
    public function produtosCliente()
    {
        return $this->hasManyThrough(Produto::class, Venda::class);
    }
}
