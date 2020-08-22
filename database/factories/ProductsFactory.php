<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'          => 'product ' . $faker->randomNumber(3, true),
        'description'   => $faker->paragraph(),
        'price'         => $faker->randomFloat(2, 0, 1000),
    ];
});
