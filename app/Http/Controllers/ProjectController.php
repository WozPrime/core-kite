<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Payment;
use App\Models\ProjectModel;
use App\Models\Instance;
use App\Models\Client;
use App\Models\InstancesModel;
use App\Models\User;
use App\Models\ProjectAll;
use App\Models\Task;
use App\Models\ProfUser;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProjectModel $projectModel, ProjectAll $projectAll, User $user,Task $task, ProjectTask $project_task)
    {
        $this->projectModel = $projectModel;
        $this->middleware('auth');
        $this->projectAll = $projectAll;
        $this->user = $user;
        $this->task = $task;
        $this->projectTask = $project_task;
    }
    public function index()
    {
        return view('pages.progress.projects', [
            'data' => ProjectModel::all(),
            'instansi' => Instance::all(),
            'klien' => Client::all(),
            'modelinstansi' => InstancesModel::all(),
            'ptask' => ProjectTask::all(),
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
        if($request->instance_id == 'yes'){
            $instansibaru = new Instance;
            $instansibaru->nama_instansi = $request->newnamainstansi;
            $instansibaru->alamat_instansi = $request->newalamatinstansi;
            $instansibaru->kota_instansi = $request->newkotainstansi;
            $instansibaru->instances_model_id = $request->newjenisinstansi;
            $instansibaru->logo_instansi = $request->newlogoinstansi;
            $instansibaru->save();
        }
        if($request->client_id == 'yes'){

            $klienuser= new User;
            $klienuser->name = $request->newnamaklien;
            $klienuser->email =  $request->newemailklien;
            $klienuser->password = bcrypt('default');
            $klienuser->role = 'client';
            $klienuser->save();

            $klienbaru = new Client;
            if($request->instance_id == 'yes'){
                $klienbaru->instance_id = Instance::where('nama_instansi',$request->newnamainstansi)->first()->id;
            }
            else{
                $klienbaru->instance_id = $request->instance_id;
            }
            $klienbaru->user_id = User::where('name',$request->newnamaklien)->first()->id;
            $klienbaru->name = $request->newnamaklien;
            $klienbaru->email = $request->newemailklien;
            $klienbaru->password = bcrypt('default');
            $klienbaru->phone_number = $request->newnomorteleponklien;
            $klienbaru->save();
        }
        $data = new ProjectModel;
        if($request->instance_id == 'yes'){
            $data->instance_id = Instance::where('nama_instansi',$request->newnamainstansi)->first()->id;
        }
        else{
            $data->instance_id = $request->instance_id;
        }
        if($request->client_id == 'yes'){
            $data->client_id = Client::where('name',$request->newnamaklien)->first()->id;
        }
        else{
            $data->client_id = $request->client_id;
        }
        if($request->project_logo<> ""){
            $file = $request->project_logo;
            $fileName = 'logo' . '_' . Request()->project_name . '.' . $file->extension();
            $file->move(public_path('projectLogo'), $fileName);

            $data->project_code = $request->project_code;
            $data->project_name = $request->project_name;
            $data->project_detail = $request->project_detail;
            $data->project_status = $request->project_status;
            $data->project_category = $request->project_category;
            $data->project_start_date = $request->project_start_date;
            $data->project_deadline = $request->project_deadline;
            $data->project_value = $request->project_value;
            $data->project_logo = $fileName;
            $data->save();
            DB::statement("ALTER TABLE `projects` AUTO_INCREMENT = 1;");
            Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
            return redirect('/admin/proyek');
        }
        else {
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
        // $part_user = DB::table('project_all')
        //     ->join('users', 'users.id', '=', 'project_all.user_id', 'right outer')
        //     ->select(['users.id', 'users.name', 'project_all.id as pt_id'])
        //     ->whereNull('project_all.id')
        //     ->get();
        // $prof_part = $this->projectAll->select('prof_id','user_id')->get();
        $participant = $this->projectAll->select('user_id')->groupBy('user_id');
        $user_task = $this->user;
        $project_task = $this->projectTask;
        // $task_prof = $this->task->find(3)->profs()->first()->id;

        // dd($this->task->find(1)->profs()->first());

        return view('pages.progress.p_detail', [
            'data' => $proyek,
            'users' =>  User::where('role','<>','client')->get(['name', 'id', 'pp']),
            // 'part_user' => $part_user,
            'project_all' => ProjectAll::all(),
            'profs' => ProfUser::all(),
            'job_list' => $this->task,
            'participant' => $participant,
            // 'prof_part' => $prof_part,
            'user_task' => $user_task,
            'project_task' => $project_task,
            'pembayaran' => Payment::where('project_id',$proyek->id)->get(),
        ]);
    }

    public function addParticipant(Request $request)
    {
        // dd($this->user->find($request->user_id)->profUser()->first());
        if($request->user_id == ""){
            Alert::warning('Warning!!', 'Tidak Ada Karyawan yang dipilih');
        } else{
            if ($this->user->find($request->user_id)->profUser()->first() == '') {
                $data = new ProjectAll;
                $data->user_id = $request->user_id;
                $data->project_id = $request->project_id;
                $data->save();
                Alert::warning('Peringatan!!', 'Profesi Karyawan Masih Belum Terdata, Bagian Profesi Akan Dikosongkan');
            } else {
                $data = new ProjectAll;
                $data->user_id = $request->user_id;
                $data->project_id = $request->project_id;
                $data->prof_id = $this->user->find($request->user_id)->profUser()->first()->prof_id;
                $data->save();
                Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
            }
        }
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
        $data = ProjectModel::find($id);
        if (
            Request()->instance_id == $data->instance_id &&
            Request()->client_id == $data->client_id &&
            Request()->project_code == $data->project_code &&
            Request()->project_name == $data->project_name &&
            Request()->project_status == $data->project_status &&
            Request()->project_category == $data->project_category &&
            Request()->project_start_date == $data->project_start_date &&
            Request()->project_deadline == $data->project_deadline &&
            Request()->project_logo == ""
        ) {
            Alert::warning('Sama', 'Data Tidak Berubah');
            return redirect()->back();
        } else {
            if (Request()->project_code != $data->project_code)
            {
            $request->validate([
                'instance_id' => 'required',
                'client_id' => 'required',
                'project_code' => 'required|unique:projects',
                'project_name' => 'required',
                'project_status' => 'required',
                'project_category' => 'required',
                'project_start_date' => 'required',
                'project_deadline' => 'required',
            ], [
                'instance_id.required' => 'Wajib diisi!!',
                'client_id.required' => 'Wajib diisi!!',
                'project_code.required' => 'Wajib diisi!!',
                'project_code.unique' => 'Kode harus unik!!',
                'project_name.required' => 'Wajib diisi!!',
                'project_status.required' => 'Wajib dipilih!!',
                'project_category.required' => 'Wajib diisi!!',
                'project_start_date' => 'Wajib diisi!!',
                'project_deadline' => 'Wajib diisi!!',
            ]);
            if($request->project_logo<> ""){
                $file = $request->project_logo;
                $fileName = 'logo' . '_' . Request()->project_name . '.' . $file->extension();
                $file->move(public_path('projectLogo'), $fileName);

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
                    'project_logo' => $fileName,
                ];
            }
            else {
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
            }
            ProjectModel::where('id', $id)->update($data);
            Alert::success('Sukses', 'Data Proyek berhasil diedit!');
            return redirect()->back();
            } else {
                $request->validate([
                    'instance_id' => 'required',
                    'client_id' => 'required',
                    'project_name' => 'required',
                    'project_status' => 'required',
                    'project_category' => 'required',
                    'project_start_date' => 'required',
                    'project_deadline' => 'required',
                ], [
                    'instance_id.required' => 'Wajib diisi!!',
                    'client_id.required' => 'Wajib diisi!!',
                    'project_name.required' => 'Wajib diisi!!',
                    'project_status.required' => 'Wajib dipilih!!',
                    'project_category.required' => 'Wajib diisi!!',
                    'project_start_date' => 'Wajib diisi!!',
                    'project_deadline' => 'Wajib diisi!!',
                ]);
                if($request->project_logo<> ""){
                    $file = $request->project_logo;
                    $fileName = 'logo' . '_' . Request()->project_name . '.' . $file->extension();
                    $file->move(public_path('projectLogo'), $fileName);
    
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
                        'project_logo' => $fileName,
                    ];
                }
                else {
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
                }
                ProjectModel::where('id', $id)->update($data);
                Alert::success('Sukses', 'Data Proyek berhasil diedit!');
                return redirect()->back();
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProjectModel::destroy('id', $id);
        Alert::success('Sukses', 'Data Proyek berhasil dihapus!');
        return redirect()->back();
    }
}
