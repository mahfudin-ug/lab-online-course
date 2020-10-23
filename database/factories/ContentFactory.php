<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Content;
use App\Course;
use Faker\Generator as Faker;

$factory->define(Content::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'course_id' => Course::all()->random()->id,
        'title' => 'Learn '. $title,
        'slug' => \Str::slug($title),
        'desc' => $faker->paragraph,
    ];
});
