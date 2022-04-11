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
use Illuminate\Support\Carbon;
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
        $from    = Carbon::now()
                ->startOfMonth()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

        $to      = Carbon::now()
                        ->endOfMonth()          // 2018-09-29 23:59:59.000000
                        ->toDateTimeString(); // 2018-09-29 23:59:59
        $input= [$from,$to];
        $pt = ProjectTask::all();
        $ptsMonth = null;
        $comp = $pt->where('status',2)->where('user_id',Auth::user()->id)->count();
        $sumt = $pt->where('user_id',Auth::user()->id)->count();
        $sumMonth = $pt->where('user_id',Auth::user()->id)->whereBetween('expired_at',$input)->count();
        foreach ($pt->where('user_id',Auth::user()->id)->whereBetween('expired_at',$input) as $pts) {
            $ptsMonth += $pts->points;
        }
        if ($sumt != 0) {
            $ct = (round($comp/$sumt,2) * 100);
        }
        else {
            $ct = 0;
        }
        $project_task =  $pt->where('user_id', Auth::user()->id)->where('status','<',2);
        $involved = $pt->where('user_id',Auth::user()->id)->groupBy('project_id')->count('project_id');
        $tasks = Task::all();
        return view('pages.emp.emp',compact('ct','involved','project_task','tasks','sumMonth','ptsMonth'));
    }

    public function jobList()
    {
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        $pt =  ProjectTask::all()->where('user_id', Auth::user()->id);
        $firstDayofMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayofMonth = Carbon::now()->endOfMonth()->toDateString();
        $date = [$firstDayofMonth,$lastDayofMonth];
        $check = $pt->where('status',2)->whereBetween('checked_at',$date)->count();
        return view('pages.emp.emp_todo', [
            'project_task' => $pt->where('status','<',2),
            'tasks' => Task::all(),
            'file_task' => Doc::all(),
            'task_list' => $pt->where('status', '>=',2),
            'check' => $check,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
}
