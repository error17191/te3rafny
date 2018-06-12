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


Auth::routes();

