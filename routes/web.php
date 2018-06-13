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

Route::get('/', function () {
    return view('welcome');
});

Route::get('make-your-test', 'MakeYourTestController@index')->name('make-your-test.index');

Route::get('make-your-test/init', 'MakeYourTestController@init')
    ->name('make-your-test.init');

Route::get('make-your-test/random', 'MakeYourTestController@random')
    ->name('make-your-test.random');

Route::post('make-your-test/question/skip', 'MakeYourTestController@skip')
    ->name('make-your-test.skip');

Route::post('make-your-test/question/accept', 'MakeYourTestController@accept')
    ->name('make-your-test.accept');

Route::post('make-your-test/question/add', 'MakeYourTestController@add')
    ->name('make-your-test.add');


Route::get('dashboard','Dashboard\DashboardController@index')->name('dashboard');

Route::get('dashboard/init','Dashboard\DashboardController@init')->name('dashboard.init');

Route::post('dashboard/questions','Dashboard\QuestionsController@store')->name('dashboard.questions.store');

Auth::routes();

