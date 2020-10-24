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

Route::view('/', 'landing')->name('welcome');
Route::get('/course/{course}', function ($course) { return view('course.course-show', compact('course')); })->name('course::show');

Route::middleware("role:$ADMIN")->group(function() {
    Route::view('qna', 'qna.question-list')->name('qna::list');
    Route::view('/log-activity', 'log-activity.log-list')->name('log::list');
});

Route::middleware("auth")->group(function() {
    Route::get('/my-course/{course}', function ($course) { return view('course.course-forum', compact('course')); })->name('course::forum');
});

Route::view('/qna/create', 'qna.question-create')->name('qna::create');
Route::view('/my-course', 'course.course-list')->name('course::list');
Route::post('/api/payment/generate', 'PaymentController@generate');

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

Route::group([
    'prefix' => '/api/chat',
    'middleware' => 'auth'
], function() {
    Route::get('/', 'ChatController@index');
    Route::post('/', 'ChatController@store');
});

Route::get('/api/log', 'LogController@index');
