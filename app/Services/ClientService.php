<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\Contracts\IClientRepository;

class ClientService
{
    /**
     * @var IClientRepository
     */
    private $repository;

    public function __construct(IClientRepository $repository)
    {
        $this->repository = $repository;
    }

}
