<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * interface ProductRepository
 *
 * @package App\Repositories\Eloquent
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * The model instance
     */
    private $model;

    /**
     * Create a new repository instance
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Return a listing of the products
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Create a new product
     *
     * @param array $attributes
     * @return Product
     */
    public function create(array $attributes): Product
    {
        return $this->model->create($attributes);
    }

    /**
     * Find specified discipline by id
     *
     * @param int $id
     * @return Product
     */
    public function findById(int $id): ?Product
    {
        return $this->model->find($id);
    }

    /**
     * Update the specified resource in storage
     *
     * @param array $attributes
     * @param int $id
     * @return Product
     */
    public function update(array $attributes, int $id): ?Product
    {
        $product = $this->model->find($id);

        if (is_null($product)) {
            throw new ModelNotFoundException();
        }

        $product->fill($attributes);
        $product->save();

        return $product;
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
}
