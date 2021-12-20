<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\JobDataController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\EmpReportController;
use App\Http\Controllers\EmpProject;

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

Route::get('/', [UserController::class, 'welcome']);

// AUTH
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::middleware(['role', 'auth'])->group(function () {
    // // ADMIN
    Route::get('/admin', [UserController::class, 'admin'])->name('admin');
    Route::get('/admin/profile/', [UserController::class, 'profile'])->name('profile');
    Route::get('/admin/tables', [UserController::class, 'tables'])->name('tables');
    Route::get('/admin/profile', [UserController::class, 'profile'])->name('profile');
    Route::resource('/admin/client', AdminClientController::class);
    // Route::get('/admin/klien',[UserController::class, 'klien'])->name('klien')->middleware(['role','auth']);
    // Route::get('/admin/klien/detail',[UserController::class, 'detailklien'])->name('detailklien')->middleware(['role','auth']);

    //KLIEN
    Route::resource('/admin/instansi', InstanceController::class);
    Route::resource('/client', ClientController::class);

    //profile
    Route::get('/admin/profile/{id}', [UserController::class, 'profile'])->name('profile');
    Route::post('/admin/profile/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/admin/profile/edit2/{id}', [UserController::class, 'edit2'])->name('edit2');
    Route::get('/admin/profile/delete/{id}', [UserController::class, 'delete_user'])->name('delete');
    Route::post('/admin/profile/cpass/{id}', [UserController::class, 'cpass'])->name('cpass');
    Route::get('/admin/manage_user/', [UserController::class, 'manage_user'])->name('manage_user');


    //Profession
    Route::get('/admin/prof/', [ProfController::class, 'index'])->name('prof');
    Route::post('/admin/ins_prof/', [ProfController::class, 'create'])->name('ins_prof');
    Route::post('/admin/edit_prof/{id}', [ProfController::class, 'edit'])->name('edit_prof');
    Route::get('/admin/delete_prof/{id}', [ProfController::class, 'delete'])->name('delete_prof');

    //Joblist
    Route::get('/admin/joblist/', [PostController::class, 'show'])->name('joblist');
    Route::post('/admin/ins_post/', [PostController::class, 'create'])->name('ins_post');
    Route::post('/admin/edit_post/{id}', [PostController::class, 'edit'])->name('edit_post');
    Route::get('/admin/delete_post/{id}', [PostController::class, 'delete'])->name('delete_post');

    //JobData
    Route::resource('admin/jobdata/', JobDataController::class);

    // PROGRESS
    Route::resource('/admin/proyek', ProjectController::class);
    Route::resource('/admin/reports', ReportController::class);
    Route::get('/admin/carbontest ', [UserController::class, 'carbontest'])->name('carbontest');
    Route::get('/admin/dataclient', [ClientController::class, 'pilihan'])->name('clientData');
});

// EMPLOYEE
Route::resource('/emp/home', EmpController::class)->middleware(['auth']);
Route::resource('/emp/reports', EmpReportController::class)->middleware(['auth']);
Route::resource('/emp/project', EmpProject::class)->middleware(['auth']);
Route::get('/emp/profile/', [UserController::class, 'profile'])->name('profile')->middleware(['auth']);
// // LANDING PAGE
