<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail(),
        'cpf' => $this->faker->cpf(false),
    ];
});
