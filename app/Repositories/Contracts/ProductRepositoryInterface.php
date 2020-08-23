<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * interface ProductRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface ProductRepositoryInterface
{
    /**
     * Return a listing of the disciplines
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Create a new product
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Find specified product by id
     *
     * @param int $id
     * @return Model
     */
    public function findById(int $id): ?Model;

    /**
     * Update the specified discipline in storage
     *
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update(array $attributes, int $id): ?Model;
}
