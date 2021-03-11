<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ReceptionDetail;
use Faker\Generator as Faker;

$factory->define(ReceptionDetail::class, function (Faker $faker) {
    return [
        'order_detail' => $faker->numberBetween($min = 2, $max = 3),
        'dish_id' => $faker->numberBetween($min = 1, $max = 3),
        'quantity' => $faker->numberBetween($min = 1, $max = 10),
        'total' => $faker->numberBetween($min = 100, $max = 9999),
    ];
});
