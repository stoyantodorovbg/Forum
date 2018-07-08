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

Route::post('/threads/{thread}/replies', 'ReplyController@store');
Route::delete('/replies/{reply}', 'ReplyController@destroy');
Route::patch('/replies/{reply}', 'ReplyController@update');

Route::resource('/threads', 'ThreadController');
Route::get('/channels/{channel}', 'ThreadController@index');

Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
