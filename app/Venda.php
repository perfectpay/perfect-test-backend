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
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    /**
     * Retorna todos os produtos da venda.
     */
    public function clientesVenda(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    /**
     * Retorna em formato DateTime.
     */
    private function convertStringToDate($param)
    {
        if(empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d H:i:s');
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

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = $this->convertStringToDate($value);
    }

    /**
     * @param $value
     * @return false|string
     */
    public function getDataAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    /**
     * @param $value
     */
    public function setDescontoAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['desconto'] = null;
        } else {
            $this->attributes['desconto'] = floatval($this->convertStringToDouble($value));
        }
    }

}
