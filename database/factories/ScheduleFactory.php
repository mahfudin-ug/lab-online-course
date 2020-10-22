<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Instructor;
use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    $course = Course::all()->random();
    $instructor = Instructor::all()->random();
    $date = $faker->date;

    return [
        'course_id' => $course->id,
        'instructor_id' => $instructor->id,
        'name' => $course->title. ' (Batch x)',
        'desc' => $faker->paragraph,
        'price'=> $faker->numberBetween(10, 50) * 10000,
        'started_at' => $date,
        'ended_at' => $faker->dateTimeBetween($date, '+15 days')
    ];
});
