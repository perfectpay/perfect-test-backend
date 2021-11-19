<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nome', 'Email', 'Cpf', 'Status', 'IdProduto', 'Quantidade', 'Desconto','created_at','updated_at',
    ];


}
