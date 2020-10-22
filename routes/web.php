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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/role', function () {
    return 'You are authorized';
})->middleware("role:$INSTRUCTOR");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
