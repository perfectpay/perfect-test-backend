<?php

declare(strict_types=1);

namespace App\Repository\Core;

use App\Entities\Client;
use App\Repository\Contracts\IClientRepository;

class ClientRepository extends BaseReposiroty implements IClientRepository
{
    /**
     * Make object Client ORM.
     *
     * @return void
     */
    public function entity()
    {
        return Client::class;
    }
}
