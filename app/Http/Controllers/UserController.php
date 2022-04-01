<?php

namespace App\Http\Controllers;

use App\Models\ProfUser;
use App\Models\ProfUserModel;
use App\Models\ProjectModel;
use App\Models\ProjectTask;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\ProjectModel;

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
        return view('pages.admin.content-admin', compact('project','task','user'));
    }

    public function tables()
    {
        return view('pages.admin.tables');
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
