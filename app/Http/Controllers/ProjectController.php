<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProjectModel;
use App\Models\Instance;
use App\Models\Client;
use App\Models\InstancesModel;
use App\Models\User;
use App\Models\JobData;
use App\Models\Post;
use App\Models\Prof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {   
        $this->ProjectModel = new ProjectModel();
        $this->middleware('auth');
    }
    public function index()
    {  
        return view('pages.progress.projects', [
            'data' => ProjectModel::all(),
            'instansi' => Instance::all(),
            'klien' => Client::all(),
            'modelinstansi' => InstancesModel::all(),
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
        $data = new ProjectModel;
        $data->instance_id = $request->instance_id;
        $data->client_id = $request->client_id;
        $data->project_code = $request->project_code;
        $data->project_name = $request->project_name;
        $data->project_detail = $request->project_detail;
        $data->project_status = $request->project_status;
        $data->project_category = $request->project_category;
        $data->project_start_date = $request->project_start_date;
        $data->project_deadline = $request->project_deadline;
        $data->project_value = $request->project_value;
        $data->save();
        DB::statement("ALTER TABLE `projects` AUTO_INCREMENT = 1;");
        Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
        return redirect('/admin/proyek');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectModel $proyek)
    {
        // dd($proyek);
        
        return view( 'pages.progress.p_detail', [
            'data' => $proyek,
            'users' => User::all(),
            'job_data' => JobData::all(),
            'profs' => Prof::all(),
            'job_list' => Post::all(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectModel $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'instance_id' => $request->instance_id,
            'client_id' => $request->client_id,
            'project_code' => $request->project_code,
            'project_name' => $request->project_name,
            'project_detail' => $request->project_detail,
            'project_status' => $request->project_status,
            'project_category' => $request->project_category,
            'project_start_date' => $request->project_start_date,
            'project_deadline' => $request->project_deadline,
            'project_value' => $request->project_value,
        ];
        ProjectModel::where('id', $id)->update($data);
        Alert::success('Sukses', 'Data Proyek berhasil diedit!');
        return redirect('/admin/proyek');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProjectModel::destroy($id);
        Alert::success('Sukses', 'Data Proyek berhasil dihapus!');
        return redirect('/admin/proyek');
    }


}
