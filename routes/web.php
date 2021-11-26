<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfController;

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
Route::get('/admin/profile/',[UserController::class, 'profile'])->name('profile')->middleware(['role','auth']);
Route::post('/admin/profile/edit/{id}',[UserController::class, 'edit'])->name('edit')->middleware(['role','auth']);
Route::post('/admin/profile/edit2/{id}',[UserController::class, 'edit2'])->name('edit2')->middleware(['role','auth']);
Route::get('/admin/profile/delete/{id}',[UserController::class, 'delete_user'])->name('delete')->middleware(['role','auth']);
Route::post('/admin/profile/cpass/{id}',[UserController::class, 'cpass'])->name('cpass')->middleware(['role','auth']);
Route::get('/admin/manage_user/',[UserController::class, 'manage_user'])->name('manage_user')->middleware(['role','auth']);

Route::get('/admin/prof/',[ProfController::class, 'index'])->name('prof')->middleware(['role','auth']);
Route::post('/admin/ins_prof/',[ProfController::class, 'create'])->name('ins_prof')->middleware(['role','auth']);
Route::post('/admin/edit_prof/{id}',[ProfController::class, 'edit'])->name('edit_prof')->middleware(['role','auth']);
Route::post('/admin/delete_prof/{id}',[ProfController::class, 'delete'])->name('delete_prof')->middleware(['role','auth']);


// EMPLOYEE
Route::get('/emp',[UserController::class, 'emp'])->name('emp');

// // LANDING PAGE

