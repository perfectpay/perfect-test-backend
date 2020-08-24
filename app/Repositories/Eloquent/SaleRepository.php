<?php

namespace App\Repositories\Eloquent;

use App\Models\Sale;
use App\Repositories\Contracts\SaleRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * Update the specified product in storage
     *
     * @param array $attributes
     * @param int $id
     * @return Sale
     */
    public function update(array $attributes, int $id): ?Sale
    {
        $sale = $this->model->find($id);

        if (is_null($sale)) {
            throw new ModelNotFoundException();
        }

        $sale->fill($attributes);
        $sale->save();

        return $sale;
    }

    /**
     * Remove the specified sale from storage
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

    /**
     * Add relationships in the search
     *
     * @param array $relationships
     * @return Builder
     */
    public function with(array $relationships): Builder
    {
        return $this->model->with($relationships);
    }
}
