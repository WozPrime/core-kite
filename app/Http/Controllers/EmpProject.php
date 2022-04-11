<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProjectModel;
use App\Models\Instance;
use App\Models\Client;
use App\Models\InstancesModel;
use App\Models\User;
use App\Models\ProfUser;
use App\Models\ProjectTask;
use App\Models\ProjectAll;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmpProject extends Controller
{
    public function __construct(ProjectModel $projectModel, ProjectAll $projectAll, User $user,Task $task, ProjectTask $project_task)
    {   
        $this->middleware('auth');
        $this->projectModel = $projectModel;
        $this->projectAll = $projectAll;
        $this->user = $user;
        $this->task = $task;
        $this->projectTask = $project_task;
    }
    public function index()
    {  
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        $list = [];
        $ptask = ProjectTask::all()->where('user_id',Auth::user()->id);
        foreach ($ptask as $plist) {
            $list[] = $plist->project_id;
        }
        return view('pages.emp.proyek.empproject', [
            'data' => ProjectModel::all()->whereIn('id',$list),
            'instansi' => Instance::all(),
            'klien' => Client::all(),
            'modelinstansi' => InstancesModel::all(),
            'ptask' => ProjectTask::all(),
        ]);
    }

    public function show($id)
    {
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        $proyek = ProjectModel::find($id);
        $participant = $this->projectAll->select('user_id')->groupBy('user_id');
        $user_task = $this->user;
        $project_task = $this->projectTask;
        // $task_prof = $this->task->find(3)->profs()->first()->id;

        // dd($this->task->find(1)->profs()->first());

        return view('pages.emp.proyek.emp_pdetail', [
            'data' => $proyek,
            'users' =>  User::get(['name', 'id', 'pp']),
            // 'part_user' => $part_user,
            'project_all' => ProjectAll::all(),
            'profs' => ProfUser::all(),
            'job_list' => $this->task,
            'participant' => $participant,
            // 'prof_part' => $prof_part,
            'user_task' => $user_task,
            'project_task' => $project_task,
        ]);
    }
}
