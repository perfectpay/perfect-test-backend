<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class sale_status
 *
 * @package App\Models
 */
class Sale extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qt_product',
        'discount',
        'sale_date',
        'client_id',
        'product_id',
        'sale_status_id',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * Get the client of the sale
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the product of the sale
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the status of the sale
     */
    public function saleStatus()
    {
        return $this->belongsTo(SaleStatus::class);
    }
}
