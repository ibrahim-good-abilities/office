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

use Illuminate\Routing\Router;

//Auth::routes();
//Route::get('logout', 'Auth\LoginController@logout');

// Route::get('/', function(){

//             if(auth()->user()){
//                 if (auth()->user()->role->role_name == 'admin') {
//                     return redirect()->route('orders');
//                 }elseif (auth()->user()->role->role_name == 'captain') {
//                     return redirect()->route('captain');
//                 }elseif (auth()->user()->role->role_name == 'cashier') {
//                     return redirect()->route('cashier');
//                 }elseif (auth()->user()->role->role_name == 'customer') {
//                     return redirect()->route('welcome');
//                 }elseif (auth()->user()->role->role_name == 'parista') {
//                     return redirect()->route('parista');
//                 }else{
//                     return redirect('/login');
//                 }
//             }else{
//                 return redirect('/login');
//             }

// })->name('home');
//Route::get('/register','RegisterController@store')->name('sign_up');

Route::get('/','IndexController@index')->name('home');

    //role
    Route::get('/role/create','RoleController@create')->name('add_role');
    Route::post('/role/store','RoleController@store')->name('store_role');
    Route::get('/role/index','RoleController@index')->name('all_roles');
    Route::get('/role/edit/{id}','RoleController@edit')->name('edit_role');
    Route::post('/role/update/{id}','RoleController@update')->name('update_role');
    Route::get('/role/delete/{id}','RoleController@destroy')->name('delete_role');
    //user
    Route::get('/users','RegisterController@index')->name('all_users');
    Route::get('/users/delete/{id}','RegisterController@destroy')->name('delete_user');
    Route::get('/users/create','RegisterController@create')->name('add_user');
    Route::post('/users/store','RegisterController@store')->name('store_user');
    Route::get('/users/edit/{id}','RegisterController@edit')->name('edit_user');
    Route::post('/users/update/{id}','RegisterController@update')->name('update_user');
    //home








