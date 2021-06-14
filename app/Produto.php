<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //criando a variavel com os campos que podem ser editados
    protected $fillable = ['produto_nome', 'descricao', 'preco'];

    public function vendas()
    {
        //referenciando Foreign key um para muitos
        return $this->hasMany(Venda::class, 'produtoId');
    }
}
