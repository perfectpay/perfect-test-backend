<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * interface ProductRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface ProductRepositoryInterface
{
    /**
     * Create a new product
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;
}
