<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Instructor;
use App\User;
use Faker\Generator as Faker;

$factory->define(Instructor::class, function (Faker $faker) {
    $user = User::all()->random();

    return [
        'user_id' => $user->id,
        'email' => $user->email,
        'phone' => '0812345678',
        'address' => $faker->streetAddress,
        'balance'=> $faker->numberBetween(0, 50) * 100000,
    ];
});
