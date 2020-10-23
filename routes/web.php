<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$ADMIN = App\User::ROLE_ADMIN;
$INSTRUCTOR = App\User::ROLE_INSTRUCTOR;
$STUDENT = App\User::ROLE_STUDENT;

Route::get('/', function () { return view('landing'); })->name('welcome');
Route::get('/course/{course}', function ($course) { return view('course.course-show', compact('course')); })->name('course::show');

Route::middleware("role:$ADMIN")->group(function() {
    Route::get('qna', function () { return view('qna.question-list'); })->name('qna::list');
});

Route::get('/log-activity', function () { return view('log-activity.log-list'); })->name('log::list');

Route::get('/qna/create', function () { return view('qna.question-create'); })->name('qna::create');

Route::get('/my-course', function () { return view('course.course-list'); })->name('course::list');

Route::get('/my-course/{course}', function ($course) { return view('course.course-forum', compact('course')); })->name('course::forum');


// Course List (Course student, course instructor (edit))

// Course Form (Create, edit)
// [OK] Course Detail (join chat)
// Course chat

// Payment
Route::get('/test', function () { return dd(\Auth::user()->student); });

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


/**
 * API
 */

Route::group([
    'prefix' => '/api/question'
], function() {

    Route::get('/', 'QuestionController@index');
    Route::post('/', 'QuestionController@store');
    Route::get('/{question}', 'QuestionController@show');
    Route::put('/{question}', 'QuestionController@update');
    Route::delete('/{question}', 'QuestionController@destroy');
    Route::post('/{question}/star', 'QuestionController@toggleStar');

    Route::post('/{question}/answer/', 'AnswerController@store');
    Route::put('/answer/{answer}', 'AnswerController@update');
    Route::delete('/answer/{answer}', 'AnswerController@destroy');
});

Route::group([
    'prefix' => '/api/course'
], function() {

    Route::get('/', 'CourseController@index');
    Route::get('/popular', 'CourseController@popularIndex');
    Route::post('/', 'CourseController@store');
    Route::get('/{course}', 'CourseController@show');
    Route::put('/{course}', 'CourseController@update');
    Route::delete('/{course}', 'CourseController@destroy');

    Route::post('/{course}/register', 'CourseController@register');

    Route::post('/{course}/content', 'ContentController@store');
    Route::get('/content/{content}', 'ContentController@show');
    Route::put('/content/{content}', 'ContentController@update');
    Route::delete('/content/{content}', 'ContentController@destroy');

});

