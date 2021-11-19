<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = "produto";
    protected $fillable= [
        'nome',
        'descricao',
        'preco',
    ];

    /**
     * Retorna todas as imagens do cliente.
     */
    public function imagesProduto(){
        return $this->hasMany(Produto::class);
    }

    /**
     * @param $value
     */
    public function setValorAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['preco'] = null;
        } else {
            $this->attributes['preco'] = floatval($this->convertStringToDouble($value));
        }
    }

    /**
     * @param $param
     * @return array|string|string[]|null
     */
    public function convertStringToDouble($param)
    {
        if (empty($param)) {
            return null;
        }
        return str_replace(',', '.', str_replace('.', '', $param));
    }
}
