<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use App\User;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $user = User::where('role', User::ROLE_STUDENT)->get()->random();

    return [
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'phone' => '0812345678',
        'address' => $faker->streetAddress,
    ];
});
