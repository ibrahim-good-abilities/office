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

Auth::routes(['register' => false]);
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', function(){
            if(auth()->user()){

                if (auth()->user()->role->slug == 'superadmin') {
                    return redirect()->route('dashboard');
                }elseif (auth()->user()->role->slug == 'admin') {
                    return redirect()->route('office_tickets');
                }elseif (auth()->user()->role->slug == 'employee') {
                    return redirect()->route('employeeTickets');
                }elseif (auth()->user()->role->slug == 'user') {
                    return redirect()->route('userTickets');
                }else{
                    return redirect('/login');
                }
            }
            return redirect('/login');
})->name('home');

// Route::get('/register','RegisterController@store')->name('sign_up');

Route::group(['middleware' => 'App\Http\Middleware\SuperAdminMiddleware'], function(){

        //home
        Route::get('/dashboard','OfficeController@summary')->name('dashboard');
        Route::get('/office/{id}/tickets','TicketController@retrieveOfficeTickets')->name('retrieve_office_tickets');

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
        Route::get('/offices/delete/{id}','OfficeController@destroy')->name('delete_office');
        Route::get('/offices/employees/{officeId}','OfficeController@officeEmployee')->name('officeEmployees');
        Route::post('/offices/updateadmin','OfficeController@updateAdmin')->name('updateAdmin');
        //services
        Route::get('/services/index','ServiceController@index')->name('all_services');
        Route::get('/services/create','ServiceController@create')->name('create_service');
        Route::post('/services/store','ServiceController@store')->name('store_service');
        Route::get('/services/edit/{id}','ServiceController@edit')->name('edit_service');
        Route::post('/services/update/{id}','ServiceController@update')->name('update_service');
        Route::get('/services/delete/{id}','ServiceController@destroy')->name('delete_service');
        //requirements
        Route::post('/requirement/store','RequirementController@store')->name('store_requirement');
        Route::get('/requirement/delete/{id}','RequirementController@destroy')->name('delete_requirement');
        //reports
        Route::get('operations','OfficeController@operations')->name('operations');
        Route::get('rates','OfficeController@rates')->name('rates');
        Route::get('attendance','OfficeController@attendance')->name('attendance');
    });




Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
        Route::get('/office/settings','OfficeController@settings')->name('settings');
        Route::post('/office/settings/store','OfficeController@storeSettings')->name('storeSettings');
        Route::get('/office/tickets','TicketController@officeTickets')->name('office_tickets');
        Route::resource('working-days', 'WorkingDayController');
        Route::resource('schedule', 'ScheduleController');
        Route::get('/working-days/delete/{id}','WorkingDayController@destroy')->name('delete_working_day');
        //user
        Route::get('/office/users','RegisterController@adminIndex')->name('admin_all_users');
        Route::get('/office/users/delete/{id}','RegisterController@adminDestroy')->name('admin_delete_user');
        Route::get('/office/users/create','RegisterController@adminCreate')->name('admin_add_user');
        Route::post('/office/users/store','RegisterController@adminStore')->name('admin_store_user');
        Route::get('/office/users/edit/{id}','RegisterController@adminEdit')->name('admin_edit_user');
        Route::post('/office/users/update/{id}','RegisterController@adminUpdate')->name('admin_update_user');
    });

Route::group(['middleware' => 'App\Http\Middleware\EmployeeMiddleware'], function(){
         Route::get('/employee/tickets','TicketController@employeeTickets')->name('employeeTickets');
         Route::get('/employee/tickets/update/{id}','TicketController@updateTicketStatus')->name('update_ticket_status');
});





