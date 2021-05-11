<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\Contracts\ISaleRepository;

class SaleService
{
    /**
     * @var ISaleRepository
     */
    private $repository;

    public function __construct(ISaleRepository $repository)
    {
        $this->repository = $repository;
    }

}
