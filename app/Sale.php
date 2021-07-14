<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use App\Product;

class Sale extends Model
{
    protected $fillable = [
        'client_id',
        'product_id',
        'quantity',
        'discount',
        'status',
        'product_price',
        'total_purchase_amount'
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function setDiscountAttribute($value){
        if (empty($value)) {
            $this->attributes['discount'] = 0;
        }else{
            $this->attributes['discount'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getCreatedAtAttribute($value){
        return date('d/m/Y H:i', strtotime($value));
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
