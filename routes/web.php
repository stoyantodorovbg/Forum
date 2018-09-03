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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/threads', 'ThreadController');
Route::get('threads/{channel}', 'ThreadsController@index');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::post('/threads/{thread}/replies', 'ReplyController@store');
Route::get('/threads/{thread}/replies', 'ReplyController@index');

Route::post('/threads/{thread}/subscriptions', 'ThreadSubscriptionController@store')->middleware('auth');
Route::delete('/threads/{thread}/subscriptions', 'ThreadSubscriptionController@destroy')->middleware('auth');

Route::patch('/replies/{reply}', 'ReplyController@update');
Route::delete('/replies/{reply}', 'ReplyController@destroy');
Route::get('/channels/{channel}', 'ThreadController@index');

Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile');

