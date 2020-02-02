<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    $name = $faker->unique()->name;
    $slug = Str::slug($name);

    return [
        'name' => $name,
        'slug' => $slug,
        'price' => $faker->randomFloat(2, 0, 8),
        'description' => $faker->text,
        'stock' => $faker->randomNumber(),
        'category_id' => factory(Category::class),
    ];
    
});
