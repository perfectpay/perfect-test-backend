<?php

declare(strict_types=1);

namespace App\Repository\Core;

use App\Entities\Sale;
use App\Repository\Contracts\ISaleRepository;

class SaleRepository extends BaseReposiroty implements ISaleRepository
{
    /**
     * Make object Client ORM.
     *
     * @return void
     */
    public function entity()
    {
        return Sale::class;
    }
}
