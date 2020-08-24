<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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
     * Return a listing of the clients
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
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
     * Return fillable fields of client model
     *
     * @return array
     */
    public function getFillable(): array
    {
        return $this->model->getFillable();
    }
}
