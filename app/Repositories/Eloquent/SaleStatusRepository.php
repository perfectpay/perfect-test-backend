<?php

namespace App\Repositories\Eloquent;

use App\Models\SaleStatus;
use App\Repositories\Contracts\SaleStatusRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SalesStatusRepository
 *
 * @package App\Repositories\Eloquent
 */
class SaleStatusRepository implements SaleStatusRepositoryInterface
{
    /**
     * The model instance
     */
    private $model;

    /**
     * Create a new repository instance
     *
     * @param SaleStatus $model
     */
    public function __construct(SaleStatus $model)
    {
        $this->model = $model;
    }

    /**
     * Return a listing of the sales status
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
