<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'id_user' => '1',
        'id_category' => $faker->numberBetween($min = 1, $max = 5),
        'name' => $faker->firstNameMale,
        'slug' => 'un-producto',
        'description' => $faker->sentence(15),
        'price' => $faker->numberBetween($min = 1, $max = 400),
        'image' => 'imagen-producto.jpg',
        'state_delete' => '0',

    ];
});
