<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface ClientRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface ClientRepositoryInterface
{
    /**
     * Return a listing of the clients
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Create a new client
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Update the specified client in storage
     *
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update(array $attributes, int $id): ?Model;

    /**
     * Return fillable fields of client model
     *
     * @return array
     */
    public function getFillable(): array;
}
