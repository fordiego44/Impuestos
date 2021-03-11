<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Costumer;
use Faker\Generator as Faker;

$factory->define(Costumer::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'last_name' => $faker->lastName,
      'dni' => $faker->numberBetween($min = 1000000, $max = 99999999),
      'phone' => $faker->phoneNumber,
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
      'direction' => $faker->streetAddress,
      'email' => $faker->unique()->safeEmail,
      'date_registration' => '2020-05-30 17:07:34',


    ];
});
