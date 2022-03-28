<?php

namespace App\Http\Controllers;

use App\Models\EmpReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectTask;
use App\Models\Doc;
use App\Models\User;
use App\Models\ProjectModel;
use App\Models\ProfUser;

class EmpReportController extends Controller
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
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        return view('pages.emp.empreport', [
            'project_task' => ProjectTask::all()->where('user_id',Auth::user()->id),
            'doc' => Doc::all(),
            'users' => User::all(),
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpReport  $empReport
     * @return \Illuminate\Http\Response
     */
    public function show(EmpReport $empReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpReport  $empReport
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpReport $empReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpReport  $empReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpReport $empReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpReport  $empReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpReport $empReport)
    {
        //
    }
}
