<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
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
     * Update the specified sale in storage
     *
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update(array $attributes, int $id): ?Model;

    /**
     * Remove the specified sale from storage
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

    /**
     * Add relationships in the search
     *
     * @param array $relationships
     * @return Builder
     */
    public function with(array $relationships): Builder;
}
