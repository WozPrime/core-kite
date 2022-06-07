<?php

namespace App\Http\Controllers;

use App\Models\ProfUser;
use App\Models\ProfUserModel;
use App\Models\ProjectModel;
use App\Models\ProjectTask;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Client;
use App\Models\Instance;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Task;
use stdClass;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    //
    private $user;

    public function __construct(User $user)
    {
        // İnitialize user property.
        $this->user = $user;
    }

    public function welcome()
    {
        return view('welcome');
    }


    public function admin()
    {
        $project = ProjectModel::all();
        $task = ProjectTask::all();
        $user = User::all();
        $client = Client::all()->count('id');
        $events = ProjectTask::all();
        $agenda = [];

        // Dedlin
        $project_task = ProjectTask::all()
        ->where('user_id', Auth::user()->id)
        ->where('status','<',2)
        ->where('start_at','<=', Carbon::now());
        $nearestDeadline = new stdClass();
        $nearestDeadline->time = null;
        $diffMinutes = null;
        foreach ($project_task as $job) {
            $subsDate = (strtotime($job->expired_at) - strtotime(Carbon::now()));
            $divDate = ($subsDate / 86400);
            if ($divDate > 0) {
                $diffMinutes = Carbon::parse($job->expired_at)->diffInRealMinutes();
                $deadlineMinutes = Carbon::parse($nearestDeadline->time)->diffInRealMinutes();
                if (!$job->post_date) {
                    if ($nearestDeadline->time == null || $deadlineMinutes > $diffMinutes) {
                        $nearestDeadline->time = date('F d, Y H:i:s', strtotime($job->expired_at));
                        $nearestDeadline->task = Task::all()
                            ->where('id', $job->task_id)
                            ->pluck('task_name')
                            ->implode(' ');
                    }
                }
            }
        }

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

        
        $list_project = DB::table('projects')->where('project_status', '!=', 'Selesai')->orderBy('id', 'desc')->take(4)->get();
                                    
        return view('pages.admin.content-admin', compact('project','task','user','agenda','client','nearestDeadline','list_project'));
    }
    public function testCalendar()
    {
        $events = ProjectTask::all();
        $agenda = [];
        function randColor1() {
            return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }
        foreach ($events as $event) {
            $start = $event->expired_at;
            $end = $event->expired_at;
            $color = randColor1();
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
        // dd($agenda);
        return view('pages.admin.testCal',['agenda' => $agenda,]);
    }

    public function tables()
    {
        $pj = ProjectModel::all();
        $task = ProjectTask::all();
        $users = User::all();
        $instances = Instance::all();
        function randColor2() {
            return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }
        // Pengguna 
        $roles = User::groupBy('role')->get('role');
        $userCt = $roles->count();
        $userLabel = [];
        $userDataset = [];
        $userBg = [];
        foreach ($roles as $role) {
            array_push($userLabel,$role->role);
        }
        for ($i=0; $i < $userCt; $i++) { 
            array_push($userDataset,$users->where('role',$userLabel[$i])->count());
            array_push($userBg,randColor2());
        }
        
        // Proyek w/ Instansi
        $pi = ProjectModel::groupBy('instance_id')->get('instance_id');
        $piCt = $pi->count();
        $idIn = [];
        $piLabel = [];
        $piDataset = [];
        $piBg = [];
        foreach ($pi as $proIn) {
            array_push($idIn,$proIn->instance_id);
        }
        foreach ($idIn as $idInstansi) {
            array_push($piLabel,$instances->where('id',$idInstansi)->first()->nama_instansi);
        }
        foreach ($idIn as $i) {
            array_push($piDataset,$pj->where('instance_id',$i)->count());
            array_push($piBg,randColor2());
        }

        // Project Terselesaikan
        
        $months = [];
        $min = null;
        $b4Ct = $pj->where('project_finished','<>',null)
        ->where('project_finished','<=',Carbon::now()->subMonth(6)->endOfMonth()->toDateString())
        ->count();
        $pjConDataset = [];
        $pjFinDataset = [];
        for ($i=6; $i > -1; $i--) { 
            
            array_push($months,Carbon::now()->startOfMonth()->subMonth($i)->format('F'));
            $allPj = $pj
            ->where('project_start_date','<=',Carbon::now()->subMonth($i)->endOfMonth()->toDateString())
            ->count();
            $fininMon = $pj
            ->where('project_finished','>=',Carbon::now()->subMonth($i)->startOfMonth()->toDateString())
            ->where('project_finished','<=',Carbon::now()->subMonth($i)->endOfMonth()->toDateString()) 
            ->count();
            $conPj = ($allPj - $fininMon) - $min - $b4Ct;
            if($fininMon > 0){
                $min += $fininMon;
            }
            array_push($pjConDataset,$conPj);
            array_push($pjFinDataset,$fininMon);
            
        }

        // Tugas Terselesaikan
        $minTask = null;
        $b4Task = $task->where('checked_at','<>',null)
        ->where('checked_at','<=',Carbon::now()->subMonth(6)->endOfMonth()->toDateString())
        ->count();
        $taskConDataset = [];
        $taskFinDataset = [];
        for ($i=6; $i > -1; $i--) { 
            
            $allTask = $task
            ->where('start_at','<=',Carbon::now()->subMonth($i)->endOfMonth()->toDateString())
            ->count();
            $checkMon = $task
            ->where('checked_at','>=',Carbon::now()->subMonth($i)->startOfMonth()->toDateString())
            ->where('checked_at','<=',Carbon::now()->subMonth($i)->endOfMonth()->toDateString()) 
            ->count();
            $conTask = ($allTask - $checkMon) - $minTask - $b4Task;
            if($checkMon > 0){
                $minTask += $checkMon;
            }
            array_push($taskConDataset,$conTask);
            array_push($taskFinDataset,$checkMon);
            // dd($allTask,$conTask,$checkMon,$b4Task);
        }

        // dd($taskConDataset,$taskFinDataset);
        // dd($userLabel,$userDataset,$userBg);

        return view('pages.admin.tables', 
        compact(
            'userLabel','userDataset','userBg',
            'piLabel','piDataset','piBg',
            'months', 'pjConDataset', 'pjFinDataset',
            'taskConDataset', 'taskFinDataset',
        ));
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $data_user = User::find($id);
        $prof_list = ProfUser::all();
        $task_list = ProjectTask::all();
        // dd($data_user->profUser);
        return view('pages.admin.profile_user', compact('data_user', 'prof_list','task_list'));
    }
    public function empprofile()
    {
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        $id= Auth::user()->id;
        $data_user = User::find($id);
        $prof_list = ProfUser::all();
        $task_list = ProjectTask::all();
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        return view('pages.emp.empprofile', compact('data_user','prof_list','task_list'));
    }

    public function cpass($id)
    {
        $user = User::find($id);
        $password = Request()->password;
        Request()->validate([
            'email' => 'email',
            'password' => 'required|confirmed|min:8',
        ], [
            'password.confirmed' => 'Cek Kembali Password!!',
        ]);
        if (Hash::check($password, $user->password)) {
            Alert::warning('Sama', 'Password Tidak Berubah');
            return redirect()->route('profile');
        } else {
            $update_data = [
                'password' => bcrypt($password)
            ];
            $this->user->editData($id, $update_data);
            Alert::success('Sukses', 'Data berhasil Diperbaharui');
            return redirect()->back();
        }
    }


    public function edit($id)
    {

        $data_user = User::find($id);
        $newProf = ProfUser::find(Request()->prof_id);
        if($data_user->profUser){
            $oldProf = $data_user->profUser->prof_id;
        } else{
            $oldProf = '';
        }
        if (
            Request()->name == $data_user->name &&
            Request()->code == $data_user->code &&
            Request()->gender == $data_user->gender &&
            Request()->stats == $data_user->stats &&
            Request()->address == $data_user->address &&
            Request()->prof_id == $oldProf &&
            Request()->role == $data_user->role &&
            Request()->pp == "" 
        ) {
            Alert::warning('Sama', 'Data Tidak Berubah');
            return redirect('/admin/profile');
        } else {
            Request()->validate([
                'name' => 'required',
                'code' => 'required|unique:users,code,' . $data_user->id,
                'gender' => 'required',
                'stats' => 'required',
                'prof_id' => 'required',
                'pp' => 'mimes:jpg,png,jpeg,bmp|max:1024',
            ], [
                'name.required' => 'Wajib Isi!!',
                'code.required' => 'Wajib Isi!!',
                'prof_id.required' => 'Wajib Isi!!',
                'gender' => 'Wajib Isi!!',
                'stats' => 'Wajib Isi!!',
            ]);
            if (Request()->pp <> "") {
                $file = Request()->pp;
                $fileName = Request()->id . '.' . $file->extension();
                $file->move(public_path('pp'), $fileName);

                $update_data = [
                    'name' => Request()->name,
                    'code' => Request()->code,
                    'gender' => Request()->gender,
                    'stats' => Request()->stats,
                    'address' => Request()->address,
                    'role' => Request()->role,
                    'pp' => $fileName,
                ];
                $this->user->editData($id, $update_data);
                if ($data_user->profUser) {
                    $data_user->profUser->prof_id = Request()->prof_id;
                    $data_user->profUser->user_id = $id;
                    $data_user->profUser->push();
                }else{
                    $data_user->profUser()->save(new ProfUserModel([
                        "user_id"=>$id,
                        "prof_id"=>$newProf->id
                    ]));
                }
            } else {

                $update_data = [
                    'name' => Request()->name,
                    'code' => Request()->code,
                    'gender' => Request()->gender,
                    'stats' => Request()->stats,
                    'address' => Request()->address,
                    'role' => Request()->role,
                ];
                $this->user->editData($id, $update_data);
                if ($data_user->profUser) {
                    $data_user->profUser->prof_id = Request()->prof_id;
                    $data_user->profUser->user_id = $id;
                    $data_user->profUser->push();
                }else{
                    $data_user->profUser()->save(new ProfUserModel([
                        "user_id"=>$id,
                        "prof_id"=>$newProf->id
                    ]));
                }
            }
            Alert::success('Sukses', 'Data berhasil Diperbaharui');
            return redirect('/admin/profile');
        }
    }

    public function edit2($id)
    {
        $data_user = User::find($id);
        $newProf = ProfUser::find(Request()->prof_id);
        if($data_user->profUser){
            $oldProf = $data_user->profUser->prof_id;
        } else{
            $oldProf = '';
        }
        if (
            Request()->name == $data_user->name &&
            Request()->code == $data_user->code &&
            Request()->gender == $data_user->gender &&
            Request()->stats == $data_user->stats &&
            Request()->address == $data_user->address &&
            Request()->prof_id == $oldProf &&
            Request()->pp == ""
        ) {
            Alert::warning('Sama', 'Data Tidak Berubah');
            return redirect('/admin/profile');
        } else {
            Request()->validate([
                'name' => 'required',
                'code' => 'unique:users,code,' . $data_user->id,
                'pp' => 'mimes:jpg,png,jpeg,bmp|max:1024',
            ], [
                'name.required' => 'Wajib Isi!!',
            ]);
            if (Request()->pp <> "") {
                $file = Request()->pp;
                $fileName = Request()->id . '.' . $file->extension();
                $file->move(public_path('pp'), $fileName);

                $update_data = [
                    'name' => Request()->name,
                    'code' => Request()->code,
                    'gender' => Request()->gender,
                    'stats' => Request()->stats,
                    'address' => Request()->address,
                    'pp' => $fileName,
                ];
                $this->user->editData($id, $update_data);
                if ($data_user->profUser) {
                    $data_user->profUser->prof_id = Request()->prof_id;
                    $data_user->profUser->user_id = $id;
                    $data_user->profUser->push();
                }else{
                    $data_user->profUser()->save(new ProfUserModel([
                        "user_id"=>$id,
                        "prof_id"=>$newProf->id
                    ]));
                }
            } else {

                $update_data = [
                    'name' => Request()->name,
                    'code' => Request()->code,
                    'gender' => Request()->gender,
                    'stats' => Request()->stats,
                    'address' => Request()->address,
                ];
                $this->user->editData($id, $update_data);
                if ($data_user->profUser) {
                    $data_user->profUser->prof_id = Request()->prof_id;
                    $data_user->profUser->user_id = $id;
                    $data_user->profUser->push();
                }else{
                    $data_user->profUser()->save(new ProfUserModel([
                        "user_id"=>$id,
                        "prof_id"=>$newProf->id
                    ]));
                }
            }
            Alert::success('Sukses', 'Data berhasil Diperbaharui');
            return redirect('/admin/profile');
        }
    }

    public function newUser(Request $req)
    {
        $newProf = ProfUser::find($req->prof_id);
        $req->validate([
            'password' => 'required|confirmed|min:8',
            'code' => 'unique:users,code,' . $req->id,
            'code' => [
                'required',
                'code',
                Rule::unique('users')->ignore($this->user->id, 'id')
            ],
            'pp' => 'mimes:jpg,png,jpeg,bmp|max:1024',
        ],[
            'password.confirmed' => 'Cek Kembali Password!!',
        ]);
        if ($req->ava <> "") {
            $file = $req->ava;
            $fileName = $req->id . '.' . $file->extension();
            $file->move(public_path('pp'), $fileName);
            
            $newUser = new User;
            $newUser->name = $req->name;
            $newUser->email = $req->email;
            $newUser->password = bcrypt($req->password);
            $newUser->code = $req->code;
            $newUser->gender = $req->gender;
            $newUser->stats = $req->stats;
            $newUser->address = $req->address;
            $newUser->pp = $req->ava;
            $newUser->save();

            User::find($newUser->id)->profUser()->save(new ProfUserModel([
                "user_id"=>$newUser->id,
                "prof_id"=>$newProf->id
            ]));

            Alert::success('Sukses', 'User berhasil ditambahkan !!!');
            return redirect('/admin/manage_user');


        } else {
            $newUser = new User;
            $newUser->name = $req->name;
            $newUser->email = $req->email;
            $newUser->password = bcrypt($req->password);
            $newUser->code = $req->code;
            $newUser->gender = $req->gender;
            $newUser->stats = $req->stats;
            $newUser->address = $req->address;
            $newUser->save();

            User::find($newUser->id)->profUser()->save(new ProfUserModel([
                "user_id"=>$newUser->id,
                "prof_id"=>$newProf->id
            ]));

            Alert::success('Sukses', 'User berhasil ditambahkan !!!');
            return redirect('/admin/manage_user');

        }
    }

    public function manage_user()
    {
        $data = User::all();
        $prof_list = ProfUser::all();
        return view('pages.admin.manajemen.muser', ['users' => $data], ['prof_list' => $prof_list]);
    }

    public function delete_user($id)
    {
        $this->user->deleteData($id);
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1;");
        Alert::success('Sukses', 'Data berhasil Diperbaharui');
        return redirect('/admin/profile');
    }
    public function klien()
    {
        return view('pages.admin.klien.overview');
    }

    public function detailklien()
    {
        return view('pages.admin.klien.detail');
    }


    public function emp()
    {
        return view('pages.emp.emp');
    }
}
