<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';

    /** The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'sale_date',
        'amount',
        'status',
        'discount',
    ];
}
