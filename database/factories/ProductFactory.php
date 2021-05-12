<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL)
    ];
});
