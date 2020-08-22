<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class VendaModel extends Model
{
    protected $table        = 'venda';
    protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $fillable     = [
        'id_produto', 'id_cliente', 'data_venda', 'quantidade', 'desconto', 'status'
    ];
}
