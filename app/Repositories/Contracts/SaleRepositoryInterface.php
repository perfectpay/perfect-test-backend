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
     * Remove the specified product from storage
     *
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int;

    /**
     * Return fillable fields of model
     *
     * @return array
     */
    public function getFillable(): array;
}
