<?php

namespace App\Repositories\Eloquent;

use App\Models\Sale;
use App\Repositories\Contracts\SaleRepositoryInterface;

/**
 * Class SaleRepository
 *
 * @package App\Repositories\Eloquent
 */
class SaleRepository implements SaleRepositoryInterface
{
    /**
     * The model instance
     */
    private $model;

    /**
     * Create a new repository instance
     *
     * @param Sale $model
     */
    public function __construct(Sale $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new sale
     *
     * @param array $attributes
     * @return Sale
     */
    public function create(array $attributes): Sale
    {
        return $this->model->create($attributes);
    }

    /**
     * Return fillable fields of sale
     *
     * @return array
     */
    public function getFillable(): array
    {
        return $this->model->getFillable();
    }
}
