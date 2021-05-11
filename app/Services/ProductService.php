<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\Contracts\IProductRepository;

class ProductService
{
    /**
     * @var IProductRepository
     */
    private $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

}
