<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {

    return [
        'user_id' => User::all()->random()->id,
        'title' => $faker->sentence .'?',
        'desc' => $faker->paragraph,
        'featured' => $faker->boolean,
        'status' => $faker->randomElement([Question::STATUS_OPEN, Question::STATUS_CLOSE, Question::STATUS_SOLVED])
    ];
});
