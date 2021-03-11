<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Attribute;

$factory->define(Attribute::class, function (Faker $faker) {
    return [
      'id_product' => $faker->numberBetween($min = 1, $max = 5),
      'name' => $faker->name,
      'value' => $faker->name,
      'variation' => '0',
      'state_delete' => '0',
    ];
});
