<?php

use Illuminate\Database\Seeder;
use App\Entities\Product;
use App\Entities\Sale;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 150)->create();
    }
}
