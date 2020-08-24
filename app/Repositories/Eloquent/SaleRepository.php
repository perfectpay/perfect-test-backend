<?php

namespace App\Repositories\Eloquent;

use App\Models\Sale;
use App\Repositories\Contracts\SaleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SaleRepository
 *
 * @package App\Repositories\Eloquent
 */
class SaleRepository implements SaleRepositoryInterface
{
    /**
     * The model instance
     */
    private $model;

    /**
     * Create a new repository instance
     *
     * @param Sale $model
     */
    public function __construct(Sale $model)
    {
        $this->model = $model;
    }

    /**
     * Return a listing of the sales
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model
            ->with([
                'client',
                'product',
                'saleStatus'
            ])
            ->get();
    }

    /**
     * Create a new sale
     *
     * @param array $attributes
     * @return Sale
     */
    public function create(array $attributes): Sale
    {
        return $this->model->create($attributes);
    }

    /**
     * Remove the specified product from storage
     *
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return $this->model->destroy($id);
    }

    /**
     * Return fillable fields of sale
     *
     * @return array
     */
    public function getFillable(): array
    {
        return $this->model->getFillable();
    }
}
