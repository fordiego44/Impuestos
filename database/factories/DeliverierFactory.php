<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deliverier;
use Faker\Generator as Faker;

$factory->define(Deliverier::class, function (Faker $faker) {
    return [
        'id_user' => $faker->numberBetween($min = 1, $max = 2),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'name' => $faker->name ,
        'last_name' => $faker->lastName ,
        'dni' =>  $faker->ean8 ,
        'direction' => $faker->streetAddress ,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'image' => 'repartidor.jpg',
        'state_deliver' => '0',
        'state_delete' => '0',
    ];
});
