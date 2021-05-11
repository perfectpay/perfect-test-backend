<?php

namespace App\Providers;


use App\Repository\Contracts\IBaseRepository;;

use App\Repository\Contracts\IClientRepository;
use App\Repository\Contracts\IProductRepository;
use App\Repository\Contracts\ISaleRepository;
use App\Repository\Core\BaseReposiroty;
use App\Repository\Core\ClientRepository;
use App\Repository\Core\ProductRepository;
use App\Repository\Core\SaleRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IBaseRepository::class,
            BaseReposiroty::class
        );

        $this->app->bind(
            IClientRepository::class,
            ClientRepository::class
        );

        $this->app->bind(
            IProductRepository::class,
            ProductRepository::class
        );

        $this->app->bind(
            ISaleRepository::class,
            SaleRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
