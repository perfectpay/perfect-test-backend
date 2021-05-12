<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\Contracts\IClientRepository;

class ClientService extends StandardService
{
    /**
     * ClientService constructor.
     * @param IClientRepository $repository
     */
    public function __construct(IClientRepository $repository)
    {
        $this->repository = $repository;
    }

}
