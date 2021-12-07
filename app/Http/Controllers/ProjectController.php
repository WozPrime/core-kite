<?php

namespace App\Http\Controllers;

use Alert;
use Carbon\Carbon;
use App\Models\ProjectModel;
use App\Models\Instance;
use App\Models\Client;
use App\Models\InstancesModel;
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
            'modelinstansi' => InstancesModel::all()
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
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
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
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    function hitung_tanggal($project_start_date) {
        $tglakhir =Carbon::parse($project_deadline);
        $tglawal = Carbon::parse($project_start_date);
        $jangka = $tglakhir->diffInYears($tgl_awal);
        $satuan = "Tahun";
        if ($usia < 1) {
            $usia = $tglakhir->diffInMonths($tglawal);
            $satuan = "Bulan";
        }
        if ($usia < 1) {
            $usia = $tglakhir->diffInDays($tglawal);
            $satuan = "Hari";
        }
        $output = $jangka . ' ' . $satuan;
        return ($output);
    }
}
