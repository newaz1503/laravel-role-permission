<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

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
Route::group(['as'=> 'admin.','prefix' => 'admin/', 'middleware' => ['auth']], function (){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');
    //role route
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
