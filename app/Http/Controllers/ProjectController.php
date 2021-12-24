<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Payment;
use App\Models\ProjectModel;
use App\Models\Instance;
use App\Models\Client;
use App\Models\InstancesModel;
use App\Models\User;
use App\Models\ProjectTask;
use App\Models\Task;
use App\Models\ProfUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProjectModel $projectModel, ProjectTask $projectTask,User $user)
    {
        $this->projectModel = $projectModel;
        $this->middleware('auth');
        $this->projectTask = $projectTask;
        $this->user = $user;
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
        return redirect()->back();
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
        $part_user = DB::table('project_task')
            ->join('users', 'users.id', '=', 'project_task.user_id', 'right outer')
            ->select(['users.id', 'users.name', 'project_task.id as pt_id'])
            ->whereNull('project_task.id')
            ->get();
        $prof_part = $this->projectTask;
        $participant = $prof_part->select('user_id')->groupBy('user_id')->get();
        $user_task = $this->user;
        $task_part = DB::table('project_task')
            ->join('tasks', 'tasks.id', '=', 'project_task.task_id')
            ->select(['tasks.id', 'tasks.task_name', 'project_task.id as pt_id'])
            ->get();
        
        // dd($participant);

        return view('pages.progress.p_detail', [
            'data' => $proyek,
            'users' =>  User::get(['name', 'id', 'pp']),
            'part_user' => $part_user,
            'project_task' => ProjectTask::all(),
            'profs' => ProfUser::all(),
            'job_list' => Task::all(),
            'participant' => $participant,
            'prof_part' => $prof_part,
            'user_task' => $user_task,
            'task_part' => $task_part,
            'pembayaran' => Payment::where('project_id',$proyek->id)->get(),
        ]);
    }

    public function addParticipant(Request $request)
    {
        $data = new ProjectTask;
        $data->user_id = $request->user_id;
        $data->project_id = $request->project_id;
        $data->save();
        Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
        return redirect()->back();
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
        return redirect()->back();
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
        return redirect()->back();
    }
}
