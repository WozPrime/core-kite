<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use App\Models\User;
use App\Models\Task;
use App\Models\ProjectTask;
use stdClass;
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
        // dedline
        
        $events = ProjectTask::all()->where('user_id',Auth::user()->id);
        $agenda = [];

        // $project_task = ProjectTask::all()
        // ->where('user_id', Auth::user()->id)
        // ->where('status','<',2)
        // ->where('start_at','<=', Carbon::now());
        // $nearestDeadline = new stdClass();
        // $nearestDeadline->time = null;
        // $diffMinutes = null;
        // foreach ($project_task as $job) {
        //     $subsDate = (strtotime($job->expired_at) - strtotime(Carbon::now()));
        //     $divDate = ($subsDate / 86400);
        //     if ($divDate > 0) {
        //         $diffMinutes = Carbon::parse($job->expired_at)->diffInRealMinutes();
        //         $deadlineMinutes = Carbon::parse($nearestDeadline->time)->diffInRealMinutes();
        //         if (!$job->post_date) {
        //             if ($nearestDeadline->time == null || $deadlineMinutes > $diffMinutes) {
        //                 $nearestDeadline->time = date('F d, Y H:i:s', strtotime($job->expired_at));
        //                 $nearestDeadline->task = Task::all()
        //                     ->where('id', $job->task_id)
        //                     ->pluck('task_name')
        //                     ->implode(' ');
        //             }
        //         }
        //     }
        // }

        // agenda
        function randColor() {
            return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }
        foreach ($events as $event) {
            $start = $event->expired_at;
            $end = $event->expired_at;
            $color = randColor();
            $backgroundColor = strtolower($color);
            $borderColor = strtolower($color);
            $title =  $event->details;
            $input = [
            'title' => $title,
            'start' => $start,
            'end' => $end,
            'backgroundColor' => $backgroundColor,
            'borderColor' => $borderColor,
            ];
            array_push($agenda,$input);
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
        $project_task =  $pt->where('user_id', Auth::user()->id)->where('status','<',2)->take(10);
        $involved = $pt->where('user_id',Auth::user()->id)->groupBy('project_id')->count('project_id');
        $tasks = Task::all();
        return view('pages.emp.emp',compact('ct','involved','project_task','tasks','sumMonth','ptsMonth',
        // 'nearestDeadline',
        'agenda'));
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
            'project_task' => $pt->where('status','<',2)->where('start_at','<=', Carbon::now()),
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
