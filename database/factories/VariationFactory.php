<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Variation;
use Faker\Generator as Faker;

$factory->define(Variation::class, function (Faker $faker) {
    return [
        'id_attribute' => $faker->numberBetween($min = 1, $max = 2) ,
        'name' => $faker->name,
        'price' => $faker->numberBetween($min = 100, $max = 9999) ,
        'image' => 'cliente.jpg',
        'available' => '0',
        'state_delete' => '1',
    ];
});
