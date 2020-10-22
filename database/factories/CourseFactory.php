<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Instructor;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $instructor = Instructor::all()->random();
    $title = $faker->sentence;

    return [
        'instructor_id' => $instructor->id,
        'title' => $title,
        'slug' => \Str::slug($title),
        'desc' => $faker->paragraph,
        'featured' => $faker->boolean
    ];
});
