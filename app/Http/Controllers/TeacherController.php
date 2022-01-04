<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //
    //
    public function welcome()
    {
        return view('welcome');
    }

    public function content()
    {
        return view('pages.teacher.courses', [
            'active' => 'courses']);
    }
    public function teacher()
    {
        $student_count = User::where('role','student')->count();
        // $user_count = User::count()->role('student');
        // $user = User::get();
        return view('pages.teacher.content-teacher', compact('student_count'));

    }

    public function absent()
    {
        return view('pages.teacher.absent');
    }

    // public function profile()
    // {
    //     return view('pages.student.absent');
    // }

    public function chatify()
    {
        return view('vendor.Chatify.pages.app');
    }

    public function courses()
    {
        return view('pages.teacher.class.courses.index');
    }

    public function cleanup($table_name)
    {
        DB::statement("ALTER TABLE `$table_name` AUTO_INCREMENT = 1;");
    }
    public function class() {
        $class = Kelas::latest()->paginate(4);
        return view('pages.teacher.class.index', compact('class'));
    }

    public function coursesCreate()
    {
        return view('pages.teacher.class.create');
    }
}
