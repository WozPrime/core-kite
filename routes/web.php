<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\PostController;

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
Route::get('/admin/tables',[UserController::class, 'tables'])->name('tables')->middleware(['role','auth']);
Route::get('/admin/profile',[UserController::class, 'profile'])->name('profile')->middleware(['role','auth']);
Route::resource('/admin/instansi', InstanceController::class)->middleware(['role', 'auth']);
// Route::get('/admin/klien',[UserController::class, 'klien'])->name('klien')->middleware(['role','auth']);
// Route::get('/admin/klien/detail',[UserController::class, 'detailklien'])->name('detailklien')->middleware(['role','auth']);

//KLIEN
Route::get('/client/projects', [ClientController::class, 'myproject'])->middleware(['role', 'auth']);
Route::resource('/client', ClientController::class);
//profile
Route::get('/admin/profile/{id}',[UserController::class, 'profile'])->name('profile')->middleware(['role','auth']);
Route::post('/admin/profile/edit/{id}',[UserController::class, 'edit'])->name('edit')->middleware(['role','auth']);
Route::post('/admin/profile/edit2/{id}',[UserController::class, 'edit2'])->name('edit2')->middleware(['role','auth']);
Route::get('/admin/profile/delete/{id}',[UserController::class, 'delete_user'])->name('delete')->middleware(['role','auth']);
Route::post('/admin/profile/cpass/{id}',[UserController::class, 'cpass'])->name('cpass')->middleware(['role','auth']);
Route::get('/admin/manage_user/',[UserController::class, 'manage_user'])->name('manage_user')->middleware(['role','auth']);


//Profession
Route::get('/admin/prof/',[ProfController::class, 'index'])->name('prof')->middleware(['role','auth']);
Route::post('/admin/ins_prof/',[ProfController::class, 'create'])->name('ins_prof')->middleware(['role','auth']);
Route::post('/admin/edit_prof/{id}',[ProfController::class, 'edit'])->name('edit_prof')->middleware(['role','auth']);
Route::get('/admin/delete_prof/{id}',[ProfController::class, 'delete'])->name('delete_prof')->middleware(['role','auth']);

//Joblist
Route::get('/admin/joblist/', [PostController::class,'show'])->name('joblist')->middleware(['role','auth']);
Route::post('/admin/ins_post/',[PostController::class, 'create'])->name('ins_post')->middleware(['role','auth']);
Route::post('/admin/edit_post/{id}',[PostController::class, 'edit'])->name('edit_post')->middleware(['role','auth']);
Route::get('/admin/delete_post/{id}',[PostController::class, 'delete'])->name('delete_post')->middleware(['role','auth']);


// EMPLOYEE
Route::get('/emp',[UserController::class, 'emp'])->name('emp');

// // LANDING PAGE

// PROGRESS
Route::resource('/admin/proyek', ProjectController::class)->middleware(['role','auth']);
Route::resource('/admin/reports', ReportController::class)->middleware(['role','auth']);
Route::get('/admin/carbontest ',[UserController::class, 'carbontest'])->name('carbontest')->middleware(['role','auth']);

