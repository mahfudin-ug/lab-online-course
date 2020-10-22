<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'question'
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
    'prefix' => 'course'
], function() {

    Route::get('/', 'CourseController@index');
    Route::post('/', 'CourseController@store');
    Route::get('/{course}', 'CourseController@show');
    Route::put('/{course}', 'CourseController@update');
    Route::delete('/{course}', 'CourseController@destroy');

    Route::post('/{course}/content', 'ContentController@store');
    Route::get('/content/{content}', 'ContentController@show');
    Route::put('/content/{content}', 'ContentController@update');
    Route::delete('/content/{content}', 'ContentController@destroy');

});

