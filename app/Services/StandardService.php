<?php

declare(strict_types=1);

namespace App\Services;

class StandardService
{
    protected $repository;

    /**
     * Get all data
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->getAllCursor();
    }

    /**
     * Find By ID
     * @param int $id
     * @return object
     */
    public function findById(int $id): object
    {
        return $this->repository->getById($id);
    }

    /**
     * Create new entitie
     * @param array $data
     * @return object
     */
    public function register(array $data): object
    {
        return $this->repository->store($data);
    }

    /**
     * Update entite
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete entitie
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

}
