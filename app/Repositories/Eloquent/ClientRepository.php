<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

/**
 * Class clientRepository
 *
 * @package App\Repositories\Eloquent
 */
class ClientRepository implements ClientRepositoryInterface
{
    /**
     * The model instance
     */
    private $model;

    /**
     * Create a new repository instance
     *
     * @param Client $model
     */
    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new client
     *
     * @param array $attributes
     * @return Client
     */
    public function create(array $attributes): Client
    {
        return $this->model->create($attributes);
    }

    /**
     * Return fillable fields of client
     *
     * @return array
     */
    public function getFillable(): array
    {
        return $this->model->getFillable();
    }
}
