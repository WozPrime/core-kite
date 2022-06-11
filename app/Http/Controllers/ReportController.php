<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTask;
use App\Models\ProjectModel;
use App\Models\ProfUser;
use App\Models\Doc;
use App\Models\User;
Use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function index()
    {
        $project_task = ProjectTask::all();
        $users = User::all();
        if (Auth::user()->privilege == null){
            $project_task = $project_task->where('user_id',Auth::user()->id);
            $users = $users->find(Auth::user()->id);
        }
        return view('pages.progress.reports', [
            'project_task' => $project_task,
            'user_task' => $project_task->groupBy('user_id'),
            'doc' => Doc::all(),
            'users' => $users,
            'proyek' => ProjectModel::all(),
            'profesi' => ProfUser::all(),
        ]);
    }

    public function downloadFile($file_name)
    {
        $file_path = public_path().'/files/task/'.$file_name;
        return response()->download($file_path);
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
    public function store($id,Request $req)
    {
        if ($req->task_points == 0) {
            ProjectTask::find($id)->update([
                'status' => 3,
                'points' => null,
                'checked_at' => Carbon::now(),
                'feedback' => $req->feedback,
            ]);
            
        }
        else {
            ProjectTask::find($id)->update([
                'status' => 2,
                'points' => $req->task_points,
                'checked_at' => Carbon::now(),
                'feedback' => $req->feedback,
            ]);
        }
        
        Alert::success('Sukses', 'Tugas Berhasil Di Nilai!!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
