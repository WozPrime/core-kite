<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
<<<<<<< HEAD
use Carbon\Carbon;
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
>>>>>>> 5dca2335975ed1b65d6e9470c60085a5f8107038

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
        return view('pages.admin.profile_user', compact('data_user'));
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
            return redirect()->route('profile')->with('sama','Password Tidak Berubah!!');
         } else {
             $update_data = [
                'password' => bcrypt($password)
            ];
            $this->user->editData($id, $update_data);
            return redirect()->route('profile')->with('pesan', 'Data Berhasil Diperbaharui!!!');
         
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
            Request()->pp == ""
        ) {
            return redirect()->route('profile')->with('sama','Data Tidak Berubah!!');
        } else {
            Request()->validate([
                'name' => 'required',
                'code' => 'required',
                'gender' => 'required',
                'stats' => 'required',
                'pp' => 'mimes:jpg,png,jpeg,bmp|max:1024',
            ], [
                'name.required' => 'Wajib Isi!!',
                'code.required' => 'Wajib Isi!!',
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
            } else {

                $update_data = [
                    'name' => Request()->name,
                    'code' => Request()->code,
                    'gender' => Request()->gender,
                    'stats' => Request()->stats,
                    'address' => Request()->address,
                ];
                $this->user->editData($id, $update_data);
            }
            return redirect()->route('profile')->with('pesan', 'Data Berhasil Diperbaharui!!!');
        }
    }

    public function emp()
    {
        return view('pages.emp.emp');
    }

    public function klien(){
        return view('pages.admin.klien.overview');
    }

    public function detailklien(){
        return view('pages.admin.klien.detail');
    }
    

    public function cleanup($table_name)
    {
        DB::statement("ALTER TABLE `$table_name` AUTO_INCREMENT = 1;");
    }
    //Progress
    public function joblist()
    {
        return view('pages.progress.joblist');
    }
}
