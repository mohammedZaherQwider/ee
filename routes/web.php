<?php

use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});



Auth::routes();
//Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('homee');


Route::group(['middleware' => ['auth']], function() {

Route::resource('roles','App\Http\Controllers\RoleController');

Route::resource('users','App\Http\Controllers\UserController');
Route::resource('employeeManager','App\Http\Controllers\EmployeeManagerController');
Route::post('employeeManager/getEmployeeByCivilRegistry',[\App\Http\Controllers\EmployeeManagerController::class, 'getEmployeeByCivilRegistry'])->name('getEmployeeByCivilRegistry');

Route::get('profile',[App\Http\Controllers\UserProfileController::class,'index']);
Route::post('profile',[App\Http\Controllers\UserProfileController::class,'updateUserDetails']);

});

Route::resource('sections',SectionsController::class);
Route::resource('requests',RequestsController::class);
Route::get('/requests_send',[RequestsController::class,'requests_send'])->name('requests_send');
Route::post('/accept/{requests}',[RequestsController::class,'accept'])->name('accept');
Route::post('/regect/{requests}',[RequestsController::class,'regect'])->name('regect');


Route::get('/{page}','App\Http\Controllers\AdminController@index');

