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
//Auth
Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
//reset password
Route::get('/resetpassword','PassportController@resetpassword');
//cities
Route::get('/cities','PassportController@cities');

Route::middleware('auth:api')->group(function () {
    Route::POST('demo', 'PassportController@details');

});
