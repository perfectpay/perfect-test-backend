<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    protected $table        = 'cliente';
    protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $fillable     = [
        'nome', 'email', 'cpf', 'situacao'
    ];
}
