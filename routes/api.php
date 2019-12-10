<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:api')->resource('/entry', 'EntryApiController');//temp deleted
Route::resource('/entry', 'EntryApiController');

Route::post('/user', 'Auth\UserApiController@store');

Route::post('/gcmtoken', 'GcmController@store');

// Route::get('/gcmTest', 'EntryApiController@gcmTest');
