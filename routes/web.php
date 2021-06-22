<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');
});


// Doctor
Route::group(['prefix' => 'doctor', 'middleware' => ['auth', 'doctor']], function () {
    Route::get('/', [\App\Http\Controllers\Doctor\DashboardController::class, 'index'])->name('doctor');
});


// Staff
Route::group(['prefix' => 'staff', 'middleware' => ['auth', 'staff']], function () {
    Route::get('/', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('staff');
});
