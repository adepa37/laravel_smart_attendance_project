<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/role-register', 'App\Http\Controllers\Admin\DashboardController@registered');
    Route::get('/role-edit/{id}', 'App\Http\Controllers\Admin\DashboardController@registeredit');
    Route::put('/role-register-update/{id}', 'App\Http\Controllers\Admin\DashboardController@registerupdate');
    Route::post('/role-delete', 'App\Http\Controllers\Admin\DashboardController@registerdelete');

    Route::get('/employees', 'App\Http\Controllers\Admin\EmployeesController@index');
    Route::get('/employees', 'App\Http\Controllers\Admin\EmployeesController@alldata');
    Route::get('/employee-edit/{id}', 'App\Http\Controllers\Admin\EmployeesController@employeesedit');
    Route::get('/addEmployees', 'App\Http\Controllers\Admin\EmployeesController@add_employees');
    Route::post('/save-employees', 'App\Http\Controllers\Admin\EmployeesController@store');
    Route::put('/employees-update/{id}', 'App\Http\Controllers\Admin\EmployeesController@employeeupdate');
    Route::post('/employees-delete', 'App\Http\Controllers\Admin\EmployeesController@employeedelete');
    // Route::get('/dashboard', 'App\Http\Controllers\Admin\EmployeesController@count');

    Route::get('/employeesearch', 'App\Http\Controllers\Admin\EmployeesController@search')->name('employeesearch.search');
    // Route::get('/employeesdetails/{id}', 'App\Http\Controllers\Admin\EmployeesController@showEmployeeDetails');

    Route::get('/employeesdetails', 'App\Http\Controllers\Admin\EmployeesController@showEmployeeDetails')->name('showEmployeeDetails');



    Route::get('/attendance', 'App\Http\Controllers\Admin\AttendanceController@index');
    Route::get('/attendance', 'App\Http\Controllers\Admin\AttendanceController@alldata');
    Route::get('/dashboard', 'App\Http\Controllers\Admin\AttendanceController@show');
    // Route::get('attendance_report', 'App\Http\Controllers\Admin\AttendanceController@generatePdf')->name('attendance_report');


    Route::get('/attendance_report', 'App\Http\Controllers\Admin\AttendanceController@show1')->name('attendance.report.show');
    Route::get('/attendance_pdf', 'App\Http\Controllers\Admin\AttendanceController@generatePdf')->name('attendance.report.pdf');

    Route::get('/visitors', 'App\Http\Controllers\Admin\VisitorsController@index');
});
