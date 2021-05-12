<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

interface IBaseRepository
{
    /**
     * Return all data.
     */
    public function getAllColection(): object;

    /**
     * Return all data easy load.
     */
    public function getAllCursor(): object;
    /**
     * @param string $column
     * @param $value
     * @return object
     */
    public function getWhereAll(string $column, $value): object;

    /**
     * @param int $id
     * @return object
     */
     public function getById(int $id): object;

    /**
     * @param array $data : Data to be recorded in the database
     */
    public function store(array $data): ?object;

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);
    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

}
