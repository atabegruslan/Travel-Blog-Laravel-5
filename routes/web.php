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

Route::get('/', function(){
	return view('menu/top_nav/welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

	Route::resource('/entry', 'EntryController');
	Route::get('/search', 'SearchController@index');

	Route::get('/android', 'PageController@android');
	Route::get('/contact', 'PageController@contact');

	Route::post('/email', 'EmailController@send');

	Route::get('auth/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
	Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

	Route::get('/log', 'LogController@index');
	Route::post('/log/restore', 'LogController@restore');
});

Route::get('/notification', 'NotificationController@index');
