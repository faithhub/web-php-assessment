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
    
    //Admin Profile Route
    Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin-profile');
    Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'change'])->name('admin-change-password');

    //Doctor Routes
    Route::get('/doctors', [\App\Http\Controllers\Admin\DoctorController::class, 'index'])->name('admin-doctors');
    Route::match(['get', 'post'], '/add-doctor', [\App\Http\Controllers\Admin\DoctorController::class, 'add_new'])->name('admin-add-doctor');
    Route::get('/view-doctor/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'view'])->name('admin-view-doctor');
    Route::get('/view-doctor-details/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'view_details'])->name('admin-view-doctor-details');
    Route::post('/edit-doctor', [\App\Http\Controllers\Admin\DoctorController::class, 'edit'])->name('admin-edit-doctor');
    Route::get('/delete-doctor/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'delete'])->name('admin-delete-doctor');

    
    //Staff Routes
    Route::get('/staffs', [\App\Http\Controllers\Admin\StaffController::class, 'index'])->name('admin-staffs');
    Route::match(['get', 'post'], '/add-staff', [\App\Http\Controllers\Admin\StaffController::class, 'add_new'])->name('admin-add-staff');
    Route::get('/view-staff/{id}', [\App\Http\Controllers\Admin\StaffController::class, 'view'])->name('admin-view-staff');
    Route::get('/view-staff-details/{id}', [\App\Http\Controllers\Admin\StaffController::class, 'view_details'])->name('admin-view-staff-details');
    Route::post('/edit-staff', [\App\Http\Controllers\Admin\StaffController::class, 'edit'])->name('admin-edit-staff');
    Route::get('/delete-staff/{id}', [\App\Http\Controllers\Admin\StaffController::class, 'delete'])->name('admin-delete-staff');

    //BRanch Route
    Route::get('/branch', [\App\Http\Controllers\Admin\BranchController::class, 'index'])->name('admin-branch');

});


// Doctor
Route::group(['prefix' => 'doctor', 'middleware' => ['auth', 'doctor']], function () {
    //Dashboard
    Route::get('/', [\App\Http\Controllers\Doctor\DashboardController::class, 'index'])->name('doctor');

    //Profile
    Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Doctor\ProfileController::class, 'index'])->name('doctor-profile');
    Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Doctor\ProfileController::class, 'change'])->name('doctor-change-password');
});


// Staff
Route::group(['prefix' => 'staff', 'middleware' => ['auth', 'staff']], function () {
    //Dashboard
    Route::get('/', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('staff');
    
    //Profile
    Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Staff\ProfileController::class, 'index'])->name('staff-profile');
    Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Staff\ProfileController::class, 'change'])->name('staff-change-password');
});
