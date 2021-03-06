<?php

use App\Models\ProjectAll;
use App\Models\ProjectTask;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FiCategoryController;
use App\Http\Controllers\ProjectAllController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\AdminMeetingController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\EmpProject;
use App\Http\Controllers\EmpReportController;

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

Route::get('/', [HomeController::class, 'index']);

// AUTH
Auth::routes([
    'register' => false,
]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::middleware(['role', 'auth'])->group(function () {
    // // ADMIN
    Route::get('/admin', [UserController::class, 'admin'])->name('admin');
    Route::get('/admin/profile/', [UserController::class, 'profile'])->name('profile');
    Route::get('/admin/tables', [UserController::class, 'tables'])->name('tables');
    Route::get('/admin/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/admin/testCal', [UserController::class, 'testCalendar'])->name('testCal');
    Route::resource('/admin/client', AdminClientController::class);
    // Route::get('/admin/klien',[UserController::class, 'klien'])->name('klien')->middleware(['role','auth']);
    // Route::get('/admin/klien/detail',[UserController::class, 'detailklien'])->name('detailklien')->middleware(['role','auth']);

    //KLIEN
    Route::resource('/admin/instansi', InstanceController::class);
    //Payment
    Route::resource('/admin/payment', PaymentController::class);
    //Meeting
    Route::resource('/admin/meetings', AdminMeetingController::class);

    //profile
    Route::get('/admin/profile/{id}', [UserController::class, 'profile'])->name('profile');
    Route::post('/admin/profile/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/admin/profile/edit2/{id}', [UserController::class, 'edit2'])->name('edit2');
    Route::get('/admin/profile/delete/{id}', [UserController::class, 'delete_user'])->name('delete');
    Route::get('/admin/manage_user/', [UserController::class, 'manage_user'])->name('manage_user');
    Route::post('/admin/manage_user/new', [UserController::class, 'newUser'])->name('newUser');


    //Profession
    Route::get('/admin/prof/', [ProfController::class, 'index'])->name('prof');
    Route::post('/admin/ins_prof/', [ProfController::class, 'create'])->name('ins_prof');
    Route::post('/admin/edit_prof/{id}', [ProfController::class, 'edit'])->name('edit_prof');
    Route::get('/admin/delete_prof/{id}', [ProfController::class, 'delete'])->name('delete_prof');

    //Joblist
    Route::get('/admin/joblist/', [TaskController::class, 'show'])->name('joblist');
    Route::post('/admin/ins_task/', [TaskController::class, 'create'])->name('ins_task');
    Route::post('/admin/edit_task/{id}', [TaskController::class, 'edit'])->name('edit_task');
    Route::get('/admin/delete_task/{id}', [TaskController::class, 'delete'])->name('delete_task');

    //ProjectAll
    Route::resource('admin/project_all/', ProjectAllController::class);
    Route::post('/admin/project/task/add', [ProjectAllController::class, 'addTags'])->name('add_tags');
    Route::get('/admin/project_all/delete/{id}', [ProjectAllController::class, 'destroy'])->name('delete_participant');
    Route::get('/admin/manage/project_all', [ProjectAllController::class, 'show'])->name('manage_task');
    Route::get('/admin/task/delete/{id}', [ProjectAllController::class, 'deleteTask'])->name('delete_active_task');
    Route::post('/admin/project_all/{id}/edit', [ProjectAllController::class, 'edit'])->name('edit_project_task');
    Route::post('/admin/document/post/{id}', [ProjectAllController::class, 'file_move'])->name('add_docs');
    Route::post('/admin/task/upload_details/{id}', [ProjectAllController::class, 'upload_details'])->name('up_details');
    Route::post('/admin/file/delete/', [ProjectAllController::class, 'deleteFile'])->name('delete_file');

    // PROGRESS
    Route::resource('/admin/proyek', ProjectController::class);
    Route::post('/admin/proyek/emp/upload', [ProjectController::class, 'addParticipant'])->name('upload_emp');
    Route::post('/admin/proyek/change_status/{id}', [ProjectController::class, 'finished'])->name('change_status');
    Route::resource('/admin/reports', ReportController::class);
    Route::post('/admin/reports/grade/{id}', [ReportController::class, 'store'])->name('grade_task');
    Route::get('/admin/file/download/{file_name}', [ReportController::class, 'downloadFile'])->name('download_file');
    Route::get('/admin/carbontest ', [UserController::class, 'carbontest'])->name('carbontest');
    Route::get('/admin/dataclient', [ClientController::class, 'pilihan'])->name('clientData');

    //Umum
    Route::resource('/admin/manage/finance', FinanceController::class);
    Route::resource('/admin/manage/ficategory', FiCategoryController::class);
    Route::post('/admin/generate-pdf', [PDFController::class, 'generatePDF']);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('/client', ClientController::class);
    Route::resource('/meetings', MeetingController::class);
    Route::post('/client/gantipassword/{id}', [ClientController::class, 'gantipassword']);
    Route::post('/client/gantipp/{id}', [ClientController::class, 'gantipp']);
    Route::get('/client/project/{id}', [ClientController::class, 'projectdetail']);
});

Route::post('/profile/cpass/{id}', [UserController::class, 'cpass'])->name('cpass')->middleware(['auth']);

Route::middleware(['auth','isMember'])->group(function () {
    // EMPLOYEE
    Route::get('/emp', [EmpController::class, 'index'])->name('emp');
    Route::resource('/emp/reports', EmpReportController::class);
    Route::get('/emp/joblist/', [EmpController::class, 'jobList'])->name('jobList');
    Route::resource('/emp/project', EmpProject::class);
    Route::get('/emp/profile/', [UserController::class, 'empprofile'])->name('empprofile');
    Route::get('/emp/file/download/{file_name}', [EmpReportController::class, 'downloadFile'])->name('empDownload');
    Route::post('/emp/document/post/{id}', [ProjectAllController::class, 'file_move'])->name('emp_add_docs');
    Route::post('/emp/task/upload_details/{id}', [ProjectAllController::class, 'upload_details'])->name('emp_up_details');
    Route::post('/emp/file/delete/', [ProjectAllController::class, 'deleteFile'])->name('emp_delete_file');
    Route::post('/emp/generate-pdf', [PDFController::class, 'generatePDF']);
});

// // LANDING PAGE
