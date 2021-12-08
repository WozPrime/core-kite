<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return view('pages.admin.content-admin');
    }

    public function tables()
    {
        return view('pages.admin.tables');
    }

    public function profile()
    {   
        $id= Auth::user()->id;
        $data_user = User::find($id);
        $prof_list = Prof::all();
        return view('pages.admin.profile_user', compact('data_user','prof_list'));
    }

    public function cpass($id)
    {
        $user = User::find($id);
        $password = Request()->password;
        Request()->validate([
            'email' => 'email',
            'password' => 'required|confirmed|min:8',
        ],[
            'password.confirmed' => 'Cek Kembali Password!!',
        ]);
        if (Hash::check($password, $user->password)) { 
            Alert::warning('Sama','Password Tidak Berubah');
            return redirect()->route('profile');
         } else {
             $update_data = [
                'password' => bcrypt($password)
            ];
            $this->user->editData($id, $update_data);
            Alert::success('Sukses','Data berhasil Diperbaharui');
            return redirect()->route('profile');
         
         }
    }


    public function edit($id)
    {
        
        $data_user = User::find($id);
        if (Request()->name == $data_user->name &&
            Request()->code == $data_user->code &&
            Request()->gender == $data_user->gender &&
            Request()->stats == $data_user->stats &&
            Request()->address == $data_user->address &&
            Request()->prof_id == $data_user->prof_id &&
            Request()->pp == ""
        ) {
            Alert::warning('Sama','Data Tidak Berubah');
            return redirect()->back();
        } else {
            Request()->validate([
                'name' => 'required',
                'code' => 'required|unique:users,code,'.$data_user->id,
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
                    'prof_id' => Request()->prof_id,
                    'pp' => $fileName,
                ];
                $this->user->editData($id, $update_data);
            } else {

                $update_data = [
                    'name' => Request()->name,
                    'code' => Request()->code,
                    'gender' => Request()->gender,
                    'stats' => Request()->stats,
                    'address' => Request()->address,
                    'prof_id' => Request()->prof_id,
                ];
                $this->user->editData($id, $update_data);
            }
            Alert::success('Sukses','Data berhasil Diperbaharui');
            return redirect()->back();
        }
    }
    
    public function edit2($id)
    {
        $data_user = User::find($id);
        if (Request()->name == $data_user->name &&
            Request()->code == $data_user->code &&
            Request()->gender == $data_user->gender &&
            Request()->stats == $data_user->stats &&
            Request()->address == $data_user->address &&
            Request()->prof_id == $data_user->prof_id &&
            Request()->pp == ""
        ) {
            Alert::warning('Sama','Data Tidak Berubah');
            return redirect()->back();
        } else {
            Request()->validate([
                'name' => 'required',
                'code' => 'unique:users,code,'.$data_user->id,
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
                    'prof_id' => Request()->prof_id,
                    'pp' => $fileName,
                ];
                $this->user->editData($id, $update_data);
            } else {

                $update_data = [
                    'name' => Request()->name,
                    'code' => Request()->code,
                    'gender' => Request()->gender,
                    'stats' => Request()->stats,
                    'address' => Request()->address,
                    'prof_id' => Request()->prof_id,
                ];
                $this->user->editData($id, $update_data);
            }
            Alert::success('Sukses','Data berhasil Diperbaharui');
            return redirect()->back();
        }
    }

    public function manage_user()
    {
        $data = User::all();
        $prof_list = Prof::all();
        return view('pages.admin.manajemen.muser',['users' => $data], ['prof_list'=> $prof_list]);
    }

    public function delete_user($id)
    {
        $this->user->deleteData($id);
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1;");
        Alert::success('Sukses','Data berhasil Diperbaharui');
        return redirect()->back();
    }
    public function klien(){
        return view('pages.admin.klien.overview');
    }

    public function detailklien(){
        return view('pages.admin.klien.detail');
    }
    

    public function emp()
    {
        return view('pages.emp.emp');
    }

}
