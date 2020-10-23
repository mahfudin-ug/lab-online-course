<?php

use App\Answer;
use App\Content;
use App\Course;
use App\Instructor;
use App\Question;
use App\Schedule;
use App\Student;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.co',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN
        ]);
        \Factory(User::class, 20)->create();
        \Factory(Instructor::class, 5)->create();
        \Factory(Student::class, 10)->create();
        \Factory(Course::class, 10)->create();
        \Factory(Content::class, 50)->create();
        \Factory(Question::class, 10)->create();
        \Factory(Answer::class, 50)->create();

        foreach(Student::all() as $student) {
            $student->courses()->save(Course::all()->random());
            $student->courses()->save(Course::all()->random());
        }
    }
}
