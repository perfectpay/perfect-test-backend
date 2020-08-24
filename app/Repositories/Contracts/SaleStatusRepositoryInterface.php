<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * interface SaleStatusRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface SaleStatusRepositoryInterface
{
    /**
     * Return a listing of the sales status
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Add relationships in the search
     *
     * @param array $relationships
     * @return Builder
     */
    public function with(array $relationships): Builder;
}