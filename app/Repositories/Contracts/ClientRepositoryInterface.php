<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface ClientRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface ClientRepositoryInterface
{
    /**
     * Create a new client
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
