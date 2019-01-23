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
Route::get('api/thread-translation', 'Api\ThreadTranslationsController@getThreadTranslation');
Route::patch('threads/api/thread-translation/{threadTranslation}', 'Api\ThreadTranslationsController@update');
Route::post('threads/api/thread-translation', 'Api\ThreadTranslationsController@store');
Route::delete('threads/api/thread-translation/{threadTranslation}', 'Api\ThreadTranslationsController@destroy');

// Back-office API routes
Route::post('admin/model-status', 'Admin\Api\AdminBaseController@toggleStatus');

Route::post('/admin/threads/index', 'Admin\Api\AdminThreadsController@index');
Route::delete('/admin/threads/{thread}', 'Admin\Api\AdminThreadsController@destroy');

Route::post('/admin/replies/index', 'Admin\Api\AdminRepliesController@index');
Route::delete('/admin/replies/{reply}', 'Admin\Api\AdminRepliesController@destroy');

Route::post('/admin/channels/index', 'Admin\Api\AdminChannelsController@index');
Route::delete('/admin/channels/{channel}', 'Admin\Api\AdminChannelsController@destroy');

Route::post('/admin/users/index', 'Admin\Api\AdminUsersController@index');
Route::delete('/admin/users/{user}', 'Admin\Api\AdminUsersController@destroy');

Route::post('/admin/labels/index', 'Admin\Api\AdminLabelsController@index');
Route::delete('/admin/labels/{label}', 'Admin\Api\AdminLabelsController@destroy');

Route::post('/admin/menus/index', 'Admin\Api\AdminMenusController@index');
Route::delete('/admin/menus/{menu}', 'Admin\Api\AdminMenusController@destroy');

Route::post('/admin/roles/index', 'Admin\Api\AdminRolesController@index');

Route::post('/admin/permissions/index', 'Admin\Api\AdminPermissionsController@index');

Route::post('/admin/rights/index', 'Admin\Api\AdminRightsController@index');

Route::post('/admin/languages/index', 'Admin\Api\AdminLanguagesController@index');

Route::post('/admin/label-translations/store', 'Admin\Api\AdminLabelTranslationsController@store');
Route::post('/admin/label-translations/{labelTranslation}', 'Admin\Api\AdminLabelTranslationsController@update');
Route::delete('/admin/label-translations/{labelTranslation}', 'Admin\Api\AdminLabelTranslationsController@destroy');

Route::post('/admin/thread-translations/store', 'Admin\Api\AdminThreadTranslationsController@store');
Route::post('/admin/thread-translations/{threadTranslation}', 'Admin\Api\AdminThreadTranslationsController@update');
Route::delete('/admin/thread-translations/{threadTranslation}', 'Admin\Api\AdminThreadTranslationsController@destroy');

Route::post('/admin/channel-translations/store', 'Admin\Api\AdminChannelTranslationsController@store');
Route::post('/admin/channel-translations/{channelTranslation}', 'Admin\Api\AdminChannelTranslationsController@update');
Route::delete('/admin/channel-translations/{channelTranslation}', 'Admin\Api\AdminChannelTranslationsController@destroy');

Route::post('/admin/language-translations/store', 'Admin\Api\AdminLanguageTranslationsController@store');
Route::post('/admin/language-translations/{languageTranslation}', 'Admin\Api\AdminLanguageTranslationsController@update');
Route::delete('/admin/language-translations/{languageTranslation}', 'Admin\Api\AdminLanguageTranslationsController@destroy');

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

Route::get('/admin/channels', 'Admin\AdminChannelsController@index')->name('admin.channels');
Route::get('/admin/channels/create', 'Admin\AdminChannelsController@create')->name('admin.channels.create');
Route::get('/admin/channels/{channel}', 'Admin\AdminChannelsController@edit')->name('admin.channels.edit');
Route::post('/admin/channels/store', 'Admin\AdminChannelsController@store')->name('admin.channels.store');
Route::post('/admin/channels/{channel}', 'Admin\AdminChannelsController@update')->name('admin.channels.update');

Route::get('/admin/labels', 'Admin\AdminLabelsController@index')->name('admin.labels');
Route::get('/admin/labels/create', 'Admin\AdminLabelsController@create')->name('admin.labels.create');
Route::get('/admin/labels/{label}', 'Admin\AdminLabelsController@edit')->name('admin.labels.edit');
Route::post('/admin/labels/store', 'Admin\AdminLabelsController@store')->name('admin.labels.store');
Route::post('/admin/labels/{label}', 'Admin\AdminLabelsController@update')->name('admin.labels.update');

Route::get('/admin/roles', 'Admin\AdminRolesController@index')->name('admin.roles');
Route::get('/admin/roles/create', 'Admin\AdminRolesController@create')->name('admin.roles.create');
Route::get('/admin/roles/{role}', 'Admin\AdminRolesController@edit')->name('admin.roles.edit');
Route::post('/admin/roles/store', 'Admin\AdminRolesController@store')->name('admin.roles.store');
Route::post('/admin/roles/{role}', 'Admin\AdminRolesController@update')->name('admin.roles.update');

Route::get('/admin/permissions', 'Admin\AdminPermissionsController@index')->name('admin.permissions');
Route::get('/admin/permissions/create', 'Admin\AdminPermissionsController@create')->name('admin.permissions.create');
Route::get('/admin/permissions/{permission}', 'Admin\AdminPermissionsController@edit')->name('admin.permissions.edit');
Route::post('/admin/permissions/store', 'Admin\AdminPermissionsController@store')->name('admin.permissions.store');
Route::post('/admin/permissions/{permission}', 'Admin\AdminPermissionsController@update')->name('admin.permissions.update');

Route::get('/admin/rights', 'Admin\AdminRightsController@index')->name('admin.rights');
Route::get('/admin/rights/create', 'Admin\AdminRightsController@create')->name('admin.rights.create');
Route::get('/admin/rights/{right}', 'Admin\AdminRightsController@edit')->name('admin.rights.edit');
Route::post('/admin/rights/store', 'Admin\AdminRightsController@store')->name('admin.rights.store');
Route::post('/admin/rights/{right}', 'Admin\AdminRightsController@update')->name('admin.rights.update');

Route::get('/admin/languages', 'Admin\AdminLanguagesController@index')->name('admin.languages');
Route::get('/admin/languages/create', 'Admin\AdminLanguagesController@create')->name('admin.languages.create');
Route::get('/admin/languages/{language}', 'Admin\AdminLanguagesController@edit')->name('admin.languages.edit');
Route::post('/admin/languages/store', 'Admin\AdminLanguagesController@store')->name('admin.languages.store');
Route::post('/admin/languages/{language}', 'Admin\AdminLanguagesController@update')->name('admin.languages.update');

Route::get('/admin/users', 'Admin\AdminUsersController@index')->name('admin.users');
Route::get('/admin/users/create', 'Admin\AdminUsersController@create')->name('admin.users.create');
Route::get('/admin/users/{user}', 'Admin\AdminUsersController@edit')->name('admin.users.edit');
Route::post('/admin/users/store', 'Admin\AdminUsersController@store')->name('admin.users.store');
Route::post('/admin/users/{user}', 'Admin\AdminUsersController@update')->name('admin.users.update');

Route::get('/admin/menus', 'Admin\AdminMenusController@index')->name('admin.menus');
Route::get('/admin/menus/create', 'Admin\AdminMenusController@create')->name('admin.menus.create');
Route::get('/admin/menus/{menu}', 'Admin\AdminMenusController@edit')->name('admin.menus.edit');
Route::post('/admin/menus/store', 'Admin\AdminMenusController@store')->name('admin.menus.store');
Route::post('/admin/menus/{menu}', 'Admin\AdminMenusController@update')->name('admin.menus.update');