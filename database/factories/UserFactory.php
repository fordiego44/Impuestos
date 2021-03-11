<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\User;

$factory->define(User::class, function (Faker $faker) {
    return [
      'company' => $faker->company,
      'slug' => 'La-empresa',
      'name' => $faker->name,
      'last_name' => $faker->name,
      'dni' =>  $faker->ean8 ,
      'ruc' => $faker->numberBetween($min = 10000000000, $max = 99999999999) ,
      'phone' => $faker->phoneNumber,
      'email' => $faker->unique()->safeEmail,
      // 'email_verified_at' => $faker->unique()->safeEmail,
      'email_susti' => $faker->unique()->safeEmail,
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
      'remember_token' => Str::random(10),
      'image' => 'listing-item-04.jpg',
      'latitude' => $faker->latitude($min = -70.23, $max = -70.24),
      'longitude' => $faker->longitude($min = -17.98, $max = -17.99),
      'address' => $faker->streetAddress ,
      'state' => '1',
      'description' => $faker->sentence(15),
      'business' => $faker->numberBetween($min = 1, $max = 7),
    ];
});
