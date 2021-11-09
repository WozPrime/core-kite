<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

// EMPLOYEE
Route::get('/emp',[UserController::class, 'emp'])->name('emp');

// // LANDING PAGE

// PROGRESS
Route::get('/admin/projects',[UserController::class, 'projects'])->name('projects')->middleware(['role','auth']);
Route::get('/admin/joblist ',[UserController::class, 'joblist'])->name('joblists')->middleware(['role','auth']);
Route::get('/admin/reports',[UserController::class, 'reports'])->name('reports')->middleware(['role','auth']);

