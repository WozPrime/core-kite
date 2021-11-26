<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use Carbon\Carbon;

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

Route::get('/',[UserController::class, 'welcome']);

// AUTH
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

// // ADMIN
Route::get('/admin',[UserController::class, 'admin'])->name('admin')->middleware(['role','auth']);
Route::get('/admin/tables',[UserController::class, 'tables'])->name('tables')->middleware(['role','auth']);
Route::get('/admin/profile',[UserController::class, 'profile'])->name('profile')->middleware(['role','auth']);
// Route::get('/admin/klien',[UserController::class, 'klien'])->name('klien')->middleware(['role','auth']);
// Route::get('/admin/klien/detail',[UserController::class, 'detailklien'])->name('detailklien')->middleware(['role','auth']);

//KLIEN
Route::resource('/admin/instansi', InstanceController::class)->middleware(['role', 'auth']);

//profile
Route::get('/admin/profile/{id}',[UserController::class, 'profile'])->name('profile')->middleware(['role','auth']);
Route::post('/admin/profile/edit/{id}',[UserController::class, 'edit'])->name('edit')->middleware(['role','auth']);
Route::post('/admin/profile/cpass/{id}',[UserController::class, 'cpass'])->name('cpass')->middleware(['role','auth']);


// EMPLOYEE
Route::get('/emp',[UserController::class, 'emp'])->name('emp');

// // LANDING PAGE

// PROGRESS
Route::resource('/admin/proyek', ProjectController::class)->middleware(['role','auth']);
Route::resource('/admin/reports', ReportController::class)->middleware(['role','auth']);
Route::get('/admin/joblist ',[UserController::class, 'joblist'])->name('joblists')->middleware(['role','auth']);
Route::get('/admin/carbontest ',[UserController::class, 'carbontest'])->name('carbontest')->middleware(['role','auth']);

