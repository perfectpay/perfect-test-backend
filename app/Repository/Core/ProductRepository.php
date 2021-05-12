<?php

declare(strict_types=1);

namespace App\Repository\Core;

use App\Entities\Product;
use App\Repository\Contracts\IProductRepository;

class ProductRepository extends BaseReposiroty implements IProductRepository
{
    /**
     * Make object Client ORM.
     *
     * @return void
     */
    public function entity()
    {
        return Product::class;
    }
}
