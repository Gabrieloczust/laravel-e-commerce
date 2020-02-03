<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'total' => $faker->randomFloat(2, 0, 8),
        'created_at' => $faker->dateTimeThisYear(),
    ];
});
