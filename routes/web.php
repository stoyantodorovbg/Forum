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
Route::post('/change-language', 'LanguageController@changeLanguage')->name('change.language');

Route::get('threads/search', 'SearchController@show');
Route::resource('threads', 'ThreadsController');
Route::get('threads/{thread}', 'ThreadsController@show')->name('threads.show');
Route::get('threads/create', 'ThreadsController@create')->name('threads.create');
Route::post('threads/{thread}', 'ThreadsController@store')->name('threads.store');
Route::delete('threads/{thread}', 'ThreadsController@destroy');
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

// Back-office API routes
Route::post('/admin/threads/index', 'Admin\Api\AdminThreadsController@index');
Route::delete('/admin/threads/{thread}', 'Admin\Api\AdminThreadsController@destroy');

Route::post('/admin/replies/index', 'Admin\Api\AdminRepliesController@index');
Route::delete('/admin/replies/{reply}', 'Admin\Api\AdminRepliesController@destroy');

Route::post('/admin/labels/index', 'Admin\Api\AdminLabelsController@index');
Route::delete('/admin/labels/{label}', 'Admin\Api\AdminLabelsController@destroy');

Route::post('/admin/label-translations/store', 'Admin\Api\AdminLabelTranslationsController@store');
Route::delete('/admin/label-translations/{translation}', 'Admin\Api\AdminLabelTranslationsController@destroy');

// Back-office routes
Route::get('/admin', 'Admin\AdminHomeController@index')->name('admin.home');

Route::get('/admin/threads', 'Admin\AdminThreadsController@index')->name('admin.threads');
Route::get('/admin/threads/create', 'Admin\AdminThreadsController@create')->name('admin.threads.create');
Route::get('/admin/threads/{thread}', 'Admin\AdminThreadsController@edit')->name('admin.threads.edit');
Route::post('/admin/threads/store', 'Admin\AdminThreadsController@store')->name('admin.threads.store');
Route::post('/admin/threads/{thread}', 'Admin\AdminThreadsController@update')->name('admin.threads.update');

Route::get('/admin/replies', 'Admin\AdminRepliesController@index')->name('admin.replies');
Route::get('/admin/replies/create', 'Admin\AdminRepliesController@create')->name('admin.replies.create');
Route::get('/admin/replies/{reply}', 'Admin\AdminRepliesController@edit')->name('admin.replies.edit');
Route::post('/admin/replies/store', 'Admin\AdminRepliesController@store')->name('admin.replies.store');
Route::post('/admin/replies/{reply}', 'Admin\AdminRepliesController@update')->name('admin.replies.update');

Route::get('/admin/labels', 'Admin\AdminLabelsController@index')->name('admin.labels');
Route::get('/admin/labels/create', 'Admin\AdminLabelsController@create')->name('admin.labels.create');
Route::get('/admin/labels/{label}', 'Admin\AdminLabelsController@edit')->name('admin.labels.edit');
Route::post('/admin/labels/store', 'Admin\AdminLabelsController@store')->name('admin.labels.store');
Route::post('/admin/labels/{label}', 'Admin\AdminLabelsController@update')->name('admin.labels.update');