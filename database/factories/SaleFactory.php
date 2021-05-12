<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Product;
use App\Entities\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'product_id' => factory(Product::class),
        'sale_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'amount' => $this->faker->numberBetween($min = 1, $max = 500) ,
        'status' => $this->faker->randomElement($array = array ('0','1', '2', '3', '4')),
        'discount' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 99),
    ];
});
