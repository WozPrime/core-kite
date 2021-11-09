<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    //
    public function welcome()
    {
        return view('welcome');
    }
    
    
    public function admin()
    {
        return view('pages.admin.content-admin');
    }

    public function tables()
    {
        return view('pages.admin.tables');
    }

    public function profile()
    {
        return view('pages.admin.profile_user');
    }

    public function emp()
    {
        return view('pages.emp.emp');
    }
    
    public function cleanup($table_name)
    {
        DB::statement("ALTER TABLE `$table_name` AUTO_INCREMENT = 1;");
    }
    //Progress
    public function reports()
    {
        return view('pages.progress.reports');
    }
    public function projects()
    {
        return view('pages.progress.projects');
    }
    public function joblist()
    {
        return view('pages.progress.joblist');
    }
}
