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

Route::get('scan', 'ScanController@index');

Route::get('/', 'HomeController@index')->name('home');
Route::get('threads/search', 'SearchController@show');
Route::resource('threads', 'ThreadsController');
Route::get('threads/{thread}', 'ThreadsController@show')->name('threads.show');
Route::get('threads/create', 'ThreadsController@create')->name('threads.create');
Route::post('threads/{thread}', 'ThreadsController@store')->name('threads.store');
Route::delete('threads/{thread}', 'ThreadsController@delete');
Route::patch('threads/{thread}', 'ThreadsController@update');
Route::get('threads/', 'ThreadsController@index')->name('threads.index');
Route::post('threads', 'ThreadsController@store')->middleware('must-be-confirmed');
Route::get('threads/{channel}', 'ThreadsController@index');
Route::post('threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::post('threads/{thread}/replies', 'RepliesController@store');
Route::get('threads/{thread}/replies', 'RepliesController@index');

Route::post('locked-threads/{thread}', 'LockedThreadsController@store')->name('locked-threads.store')->middleware('admin');
Route::delete('locked-threads/{thread}', 'LockedThreadsController@destroy')->name('locked-threads.destroy')->middleware('admin');

Route::post('replies/{reply}/best', 'BestRepliesController@store')->name('best-replies.store');

Route::post('threads/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');
Route::delete('threads/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->middleware('auth');

Route::patch('replies/{reply}', 'RepliesController@update');
Route::delete('replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');
Route::get('channels/{channel}', 'ThreadsController@index');

Route::post('replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('replies/{reply}/favorites', 'FavoritesController@destroy');

Route::get('profiles/{user}', 'ProfilesController@show')->name('profile');

Route::get('profiles/{user}/notifications', 'UserNotificationsController@index');
Route::delete('profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');

Route::get('register/confirm', 'Api\RegisterConformationController@index')->name('register.confirm');

// API routes
Route::get('api/users', 'Api\UsersController@index');
Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth')->name('avatar_path');

// Back-office routes
Route::get('/admin', 'Admin\AdminHomeController@index')->name('admin.home');
