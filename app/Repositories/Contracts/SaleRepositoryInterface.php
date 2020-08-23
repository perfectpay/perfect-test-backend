<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface SaleRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface SaleRepositoryInterface
{
    /**
     * Create a new product
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Return fillable fields of model
     *
     * @return array
     */
    public function getFillable(): array;
}
