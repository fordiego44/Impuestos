<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'id_user' => '1',
        'name' => $faker->firstNameMale,
        'description' => $faker->sentence(15),
        'order_start' => $faker->numberBetween($min = 1, $max = 5),
        'state_delete' => '0',
    ];
});
