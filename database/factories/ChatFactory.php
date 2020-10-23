<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Chat;
use App\User;
use Faker\Generator as Faker;

$factory->define(Chat::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence(),
        'user_id' => User::all()->random()->id,
        'course_id' => Course::all()->random()->id,
    ];
});
