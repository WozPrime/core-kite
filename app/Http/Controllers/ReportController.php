<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\ProjectTask;
use App\Models\Doc;
Use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {   
        $this->report = new Report();
        $this->middleware('auth');
    }
    public function index()
    {
        return view('pages.progress.reports', [
            'data' => Report::all(),
            'project_task' => ProjectTask::all(),
            'doc' => Doc::all(),
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
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
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
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
