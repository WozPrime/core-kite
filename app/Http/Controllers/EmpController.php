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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpModel  $empModel
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpModel  $empModel
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpModel $empModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpModel  $empModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpModel $empModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpModel  $empModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpModel $empModel)
    {
        //
    }
}
