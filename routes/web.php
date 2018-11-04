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
Route::resource('/threads', 'ThreadsController');
Route::get('threads/{channel}', 'ThreadsController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::post('/threads/{thread}/replies', 'RepliesController@store');
Route::get('/threads/{thread}/replies', 'RepliesController@index');

Route::post('/threads/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');
Route::delete('/threads/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->middleware('auth');

Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy');
Route::get('/channels/{channel}', 'ThreadsController@index');

Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');

Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');