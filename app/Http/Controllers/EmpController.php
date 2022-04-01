<?php

namespace App\Http\Controllers;

use App\Models\EmpModel;
use App\Models\ProjectModel;
use App\Models\ProjectAll;
use App\Models\ProfUser;
use App\Models\Doc;
use App\Models\User;
use App\Models\Task;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $user)
    {   
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        return view('pages.emp.emp');
    }

    public function jobList()
    {
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        $pt =  ProjectTask::all()->where('user_id', Auth::user()->id);
        return view('pages.emp.emp_todo', [
            'project_task' => $pt->where('status','<',2),
            'tasks' => Task::all(),
            'file_task' => Doc::all(),
            'task_list' => $pt->where('status', '>=',2),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
}
