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
    //city
    Route::get('/cities/index','CityController@index')->name('all_cities');
    Route::get('/cities/create','CityController@create')->name('create_city');
    Route::post('/cities/store','CityController@store')->name('store_city');
    Route::get('/cities/edit/{id}','CityController@edit')->name('edit_city');
    Route::post('/cities/update/{id}','CityController@update')->name('update_city');
    Route::get('/cities/delete{id}','CityController@destroy')->name('delete_city');
    //office
    Route::get('/offices/index','OfficeController@index')->name('all_offices');
    Route::get('/offices/create','OfficeController@create')->name('create_office');
    Route::post('/offices/store','OfficeController@store')->name('store_office');
    Route::get('/offices/edit/{id}','OfficeController@edit')->name('edit_office');
    Route::post('/offices/update/{id}','OfficeController@update')->name('update_office');
    Route::get('/offices/delete{id}','OfficeController@destroy')->name('delete_office');






