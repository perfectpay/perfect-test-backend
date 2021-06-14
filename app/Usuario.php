<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //criando a variavel com os campos que podem ser editados
    protected $fillable = ['usuario_nome', 'email', 'cpf'];

    public function compras()
    {
        //referenciando Foreign key um para muitos
        return $this->hasMany(Venda::class, 'usuarioId');
    }
}