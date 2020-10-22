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
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'Admin',
            'email' => env('APP_MAIL_ADMIN'),
            'password' => bcrypt('passowrd'),
            'role' => User::ROLE_ADMIN
        ]);
        \Factory(User::class, 10)->create();
        \Factory(Instructor::class, 5)->create();
        \Factory(Student::class, 10)->create();
        \Factory(Course::class, 10)->create();
        \Factory(Content::class, 50)->create();
        \Factory(Schedule::class, 10)->create();
        \Factory(Question::class, 10)->create();
        \Factory(Answer::class, 50)->create();
    }
}
