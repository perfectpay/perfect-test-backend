<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    ProductRepositoryInterface,
    SaleStatusRepositoryInterface
};
use App\Repositories\Eloquent\{
    ProductRepository,
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
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
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
