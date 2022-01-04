<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\User;
use App\Http\Controllers\ClassController;
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
Route::middleware(['auth','isAdmin'])->group( function(){
    Route::get('/admin',[UserController::class, 'admin'])->name('admin');
    Route::get('/admin/tables', [UserController::class, 'showtable'])->name('admin');
    Route::get('/admin/tableedit/{id}', [UserController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/tableedit/{id}', [UserController::class, 'update'])->name('admin.update');
    Route::delete('/admin/destroy/{id}', [UserController::class, 'destroy'])->name('admin.destroy');

    Route::get('/admin/users/create',[UserController::class, 'userCreate'])->name('admin.user_create');
    Route::post('/admin/users/store',[UserController::class, 'userStore'])->name('admin.user_store');
});

// Route::resource('admin', UserController::class);


// TEACHER
Route::middleware(['auth','isTeacher'])->group( function(){
    Route::get('/teacher',[TeacherController::class, 'teacher'])->name('teacher');
    Route::get('/teacher/class', [TeacherController::class, 'class']);
    Route::get('/teacher/class/create', [TeacherController::class, 'classCreate'])->name('teacher.class.create');
    Route::post('/teacher/class/create', [TeacherController::class, 'classStore'])->name('teacher.class.store');
    Route::get('/teacher/absent' , [TeacherController::class, 'absent']);
    Route::get('/teacher/class/courses', [TeacherController::class, 'courses'])->name('teacher.class.courses');
});

// STUDENT
Route::middleware(['auth','isStudent'])->group( function() {
    Route::get('/student', [StudentController::class, 'student'])->name('student');
    Route::get('/student/class', [StudentController::class, 'class']);
    Route::get('/student/absent', [StudentController::class, 'absent']);
    Route::get('/student/class/courses', [StudentController::class, 'courses'])->name('student.class.courses');
});

//CLASS
// Route::resource('class','ClassController');
// Route::get('class/{id}/edit/','ClassController@edit');
Route::get('/class', [ClassController::class, 'index'])->name('class.index');
Route::post('class/create', [ClassController::class,'store'])->name('class.store');

//EMP
Route::get('/emp',[UserController::class, 'emp'])->name('emp');
