<?php

declare(strict_types=1);

namespace App\Repository\Core;

use App\Repository\Contracts\IBaseRepository;
use App\Repository\Exception\NotEntityDefined;
use Illuminate\Support\Facades\DB;

class BaseReposiroty implements IBaseRepository
{
    protected $entity;

    public function __construct()
    {
        $this->entity = $this->resolvEntity();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     * @throws NotEntityDefined
     *
     */
    public function resolvEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NotEntityDefined();
        }

        return app($this->entity());
    }

    /**
     * Retrieve all entity data.
     */
    public function getAllColection(): object
    {
        return $this->entity->get();
    }

    /**
     * Retrieve all entity data easy load.
     */
    public function getAllCursor(): object
    {
        return $this->entity->cursor();
    }
     /**
     * @param int $id
     * @return object
     */
    public function getById(int $id): object
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Returns all records with clause where.
     *
     * @param string $column : Entity column name
     * @param $value : Value to be searched
     */
    public function getWhereAll(string $column, $value): object
    {
        return $this->entity->where($column, $value)->get();
    }

    /**
     * Wites a new record to the database.
     *
     * @param array $data : Data to be recorded in the database
     */
    public function store(array $data): ?object
    {
        try {
            DB::beginTransaction();

            $store = $this->entity->create($data);

            DB::commit();

            return $store->refresh();
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
    }

    /**
     * update record in database by ID.
     *
     * @param int   $id   :  Entity id code
     * @param array $data : Data to be recorded in the database
     */
    public function update(int $id, array $data)
    {
        try {
            DB::beginTransaction();

            $update = $this->entity->findOrfail($id)->update($data);

            DB::commit();

            return $update;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Remove record in database by ID.
     *
     * @param int $id : Entity id code
     *
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
            DB::beginTransaction();

            $this->entity->findOrfail($id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
    }

}
