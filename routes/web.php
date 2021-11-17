<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;

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
Route::get('/admin/profile/{id}',[UserController::class, 'profile'])->name('profile')->middleware(['role','auth']);
Route::post('/admin/profile/edit/{id}',[UserController::class, 'edit'])->name('edit')->middleware(['role','auth']);


// EMPLOYEE
Route::get('/emp',[UserController::class, 'emp'])->name('emp');

// // LANDING PAGE

// PROGRESS
Route::resource('/admin/projects', ProjectController::class)->middleware(['role','auth']);
Route::resource('/admin/reports', ReportController::class)->middleware(['role','auth']);
Route::get('/admin/joblist ',[UserController::class, 'joblist'])->name('joblists')->middleware(['role','auth']);

