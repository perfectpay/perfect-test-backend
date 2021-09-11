<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nome', 'Nome', 'Cpf','Status', 'IdProduto', 'Quantidade', 'Desconto',
    ];


}
