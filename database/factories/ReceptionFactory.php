<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reception;
use Faker\Generator as Faker;

$factory->define(Reception::class, function (Faker $faker) {
    return [
        'id_user' => '1',
        'deliverier_id' => $faker->numberBetween($min = 1, $max = 2),
        'pending' => $faker->numberBetween($min = 1, $max = 3),
        'customer_id' => $faker->numberBetween($min = 1, $max = 2),
        'coupon' => '0',
        'state' => '1',
        'date_reception' => '2020-05-30 17:07:34',
        'latitude' => $faker->latitude($min = -70.23, $max = -70.24),
        'longitude' => $faker->longitude($min = -17.98, $max = -17.99),

    ];
});
