<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface SaleRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface SaleRepositoryInterface
{
    /**
     * Return a listing of the sales
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Create a new sale
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
