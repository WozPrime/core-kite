<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    //
    public function welcome()
    {
        return view('welcome');
    }

    public function content()
    {
        return view('pages.student.courses', [
            'active' => 'courses']);
    }
    public function student()
    {
        return view('pages.student.content-student');
    }

    public function absent()
    {
        $users = User::all();
        return view ('pages.student.absent', ['users' => $users]);
    }

    public function courses()
    {
        return view('pages.student.class.courses.index');
    }

    public function class() {
        $class = Kelas::latest()->paginate(4);
        return view('pages.student.class.index', compact('class'));
    }
    public function profile()
    {
        return view('pages.student.absent');
    }

    public function cleanup($table_name)
    {
        DB::statement("ALTER TABLE `$table_name` AUTO_INCREMENT = 1;");
    }
}
