<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

/**
 * interface ProductRepository
 *
 * @package App\Repositories\Eloquent
 */
class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    /**
     * Create a new repository instance
     *
     * @param Discipline $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new product
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Product
    {
        return parent::create($attributes);
    }
}
