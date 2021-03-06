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
//services
Route::get('/services','PassportController@services');
//working days
Route::get('office/{officeId}/working-days','PassportController@workingDays');
//testUploadFile
Route::post('/uploadfile','PassportController@uploadfile');

Route::middleware('auth:api')->group(function () {
    Route::POST('demo', 'PassportController@details');
    Route::POST('create/ticket','PassportController@createTicket');
    Route::post('payment','PassportController@payment');
    Route::post('rate','PassportController@rate');
    Route::POST('cancel/ticket','PassportController@cancelTicket');
    Route::get('history','PassportController@history');
});
