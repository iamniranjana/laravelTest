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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();



Route::middleware('auth')->group(function () {

    Route::get('profile/{user}',  ['as' => 'users.edit', 'uses' => 'HomeController@edit']);
Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'HomeController@update']);

});
