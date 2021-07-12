<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    public function getPriceAttribute($value){
        return number_format($value, 2, ',', '.');
    }

    public function setPriceAttribute($value){
        if (empty($value)) {
            $this->attributes['price'] = null;
        }else{
            $this->attributes['price'] = floatval($this->convertStringToDouble($value));
        }
    }

    //Converter para moeda (para enviar o dado para o BD)
    private function convertStringToDouble(?string $param){ //'?' indica  que  pode  ser nulo ou string
        if(empty($param)){
            //Se vazio retorna null pois estamos tratando moeda
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
    }
}
