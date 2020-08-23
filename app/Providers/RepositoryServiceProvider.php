<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    ClientRepositoryInterface,
    ProductRepositoryInterface,
    SaleRepositoryInterface,
    SaleStatusRepositoryInterface
};
use App\Repositories\Eloquent\{
    ClientRepository,
    ProductRepository,
    SaleRepository,
    SaleStatusRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(SaleRepositoryInterface::class, SaleRepository::class);
        $this->app->bind(SaleStatusRepositoryInterface::class, SaleStatusRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
