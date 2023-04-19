<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/* Creating a dummy data for products table */
$factory->define(Product::class, function (Faker $faker) {
    $pdName=$faker->unique()->word;
    return [
        'name' => Str::of($pdName)->ucfirst(),
        'price' => $faker->randomFloat(2,1,10),
        'description' => $faker->text,
    ];
});
