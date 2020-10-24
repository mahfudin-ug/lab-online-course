<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Instructor;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $instructor = Instructor::all()->random();
    $title = $faker->sentence;
    $date = $faker->date;

    return [
        'instructor_id' => $instructor->id,
        'title' => 'Course - '. $title,
        'slug' => \Str::slug($title),
        'desc' => $faker->paragraph,
        'featured' => $faker->boolean,
        'price'=> $faker->numberBetween(10, 50) * 10000,
        'started_at' => $date,
        'ended_at' => $faker->dateTimeBetween($date, '+15 days')
    ];
});
