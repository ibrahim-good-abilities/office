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
Route::post('login', 'PassportController@login')->middleware('cors');
Route::post('register', 'PassportController@register')->middleware('cors');

//reset password
Route::get('/resetpassword','PassportController@resetpassword')->middleware('cors');
//cities
Route::get('/cities','PassportController@cities')->middleware('cors');
//services
Route::get('/services','PassportController@services')->middleware('cors');
//working days
Route::get('office/{officeId}/working-days','PassportController@workingDays')->middleware('cors');

Route::middleware('auth:api')->group(function () {
    Route::POST('demo', 'PassportController@details');
    Route::POST('create/ticket','PassportController@createTicket');
    Route::post('requirements','PassportController@payment');
    Route::POST('cancel/ticket','PassportController@cancelTicket');
});
