<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\Question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'question_id' => Question::all()->random()->id,
        'user_id' => User::all()->random()->id,
        'answer' => $faker->paragraph()
    ];
});
