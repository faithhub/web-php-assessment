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
    return view('auth.login');
});

Auth::routes();

// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');

    //Admin Profile Route
    Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin-profile');
    Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'change'])->name('admin-change-password');

    //Admin Routes
    Route::get('/admins', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin-admins');
    Route::match(['get', 'post'], '/add-admin', [\App\Http\Controllers\Admin\AdminController::class, 'add_new'])->name('admin-add-admin');
    Route::get('/view-admin/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'view'])->name('admin-view-admin');
    Route::get('/view-admin-details/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'view_details'])->name('admin-view-admin-details');
    Route::post('/edit-admin', [\App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin-edit-admin');
    Route::get('/delete-admin/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'delete'])->name('admin-delete-admin');

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

    //Branch Route
    Route::get('/branches', [\App\Http\Controllers\Admin\BranchController::class, 'index'])->name('admin-branches');
    Route::match(['get', 'post'], '/add-branch', [\App\Http\Controllers\Admin\BranchController::class, 'add_new'])->name('admin-add-branch');
    Route::get('/edit-branch/{id}', [\App\Http\Controllers\Admin\BranchController::class, 'edit_detail'])->name('admin-edit-branch');
    Route::post('/edit-branch', [\App\Http\Controllers\Admin\BranchController::class, 'edit'])->name('admin-edit');
    Route::get('/delete-branch/{id}', [\App\Http\Controllers\Admin\BranchController::class, 'delete'])->name('admin-delete-branch');
});


// Doctor
Route::group(['prefix' => 'doctor', 'middleware' => ['auth', 'doctor']], function () {
    //Dashboard
    Route::get('/', [\App\Http\Controllers\Doctor\DashboardController::class, 'index'])->name('doctor');

    //Profile
    Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Doctor\ProfileController::class, 'index'])->name('doctor-profile');
    Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Doctor\ProfileController::class, 'change'])->name('doctor-change-password');

    //Patient
    Route::match(['get', 'post'], '/patients', [\App\Http\Controllers\Doctor\PatientController::class, 'index'])->name('doctor-patients');
    Route::get('/patient-graph', [\App\Http\Controllers\Doctor\PatientController::class, 'graph'])->name('doctor-patient-graph');
    Route::get('/patient-graph-chart', [\App\Http\Controllers\Doctor\PatientController::class, 'chart'])->name('doctor-patient-graph-chart');
});


// Staff
Route::group(['prefix' => 'staff', 'middleware' => ['auth', 'staff']], function () {
    //Dashboard
    Route::get('/', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('staff');

    //Profile
    Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Staff\ProfileController::class, 'index'])->name('staff-profile');
    Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Staff\ProfileController::class, 'change'])->name('staff-change-password');

    //Patient
    Route::match(['get', 'post'], '/patients', [\App\Http\Controllers\Staff\PatientController::class, 'index'])->name('patients');
    Route::get('/patient/{id}', [\App\Http\Controllers\Staff\PatientController::class, 'view_details'])->name('staff-view-patient-details');
    Route::match(['get', 'post'], '/add-patient', [\App\Http\Controllers\Staff\PatientController::class, 'add_new'])->name('staff-add-patient');
    Route::get('/edit-patient/{id}', [\App\Http\Controllers\Staff\PatientController::class, 'view'])->name('staff-edit-patient');
    Route::get('/delete-patient/{id}', [\App\Http\Controllers\Staff\PatientController::class, 'delete'])->name('staff-delete-patient');
});
