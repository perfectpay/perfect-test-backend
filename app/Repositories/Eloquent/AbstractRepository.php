<?php
namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * The model instance
     */
    protected $model;

    /**
     * Return a listing of the resources
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find specified resource by id
     *
     * @var int $id
     * @return Model
     */
    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Create a new resource
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Update the specified resource in storage
     *
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update(array $attributes, int $id): ?Model
    {
        $resource = $this->model->find($id);

        if(is_null($resource)) {
            throw new \Exception('record not found');
        }

        return $resource->update($attributes);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return $this->model->destroy($id);
    }
}
