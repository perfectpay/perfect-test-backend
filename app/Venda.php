<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    //criando a variavel com os campos que podem ser editados
    protected $fillable = ['dataVenda', 'quantidadeProduto', 'desconto', 'statusVenda', 'produtoId', 'usuarioId, vendaValorTotal'];
}
