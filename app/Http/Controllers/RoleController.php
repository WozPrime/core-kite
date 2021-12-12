<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(RoleUser $role)
    {
        // İnitialize user property.
        $this->role = $role;
    }

    public function index()
    {
        $role_list = RoleUser::all();
        return view('pages.admin.manajemen.mprof', compact('role_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Request()->validate([
                'role_code' => 'required|unique:roles,role_code,'.Request()->id,
                'role_name' => 'required',
                'role_img' => 'mimes:jpg,png,jpeg,bmp|max:5120',
            ], [
                'role_code.required' => 'Wajib Isi!!',
                'role_name.required' => 'Wajib Isi!!',
            ]);
            if (Request()->role_img <> "") {
                $file = Request()->role_img;
                $fileName = Request()->id . '.' . $file->extension();
                $file->move(public_path('role'), $fileName);

                $insert_data = [
                    'role_code' => Request()->role_code,
                    'role_name' => Request()->role_name,
                    'detail' => Request()->detail,
                    'role_img' => $fileName,
                ];
                $this->role->insertData($insert_data);
            } else {

                $insert_data = [
                    'role_code' => Request()->role_code,
                    'role_name' => Request()->role_name,
                    'detail' => Request()->detail,
                ];
                $this->role->insertData($insert_data);
            }
            Alert::success('Sukses','Data berhasil Diperbaharui');
            return redirect()->back();
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
     * @param  \App\Models\RoleUser  $role
     * @return \Illuminate\Http\Response
     */
    public function show(RoleUser $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleUser  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_role = $this->role->find($id);
        if (Request()->role_code == $data_role->role_code &&
        Request()->role_name == $data_role->role_name &&
        Request()->detail == $data_role->detail &&
        Request()->role_img == ""
        ) {
            Alert::warning('Sama','Data Tidak Berubah');
            return redirect()->back();
        } else {
            Request()->validate([
                'role_code' => 'required|unique:roles,role_code,'.Request()->id,
                'role_name' => 'required',
                'role_img' => 'mimes:jpg,png,jpeg,bmp|max:5120',
            ], [
                'role_code.required' => 'Wajib Isi!!',
                'role_name.required' => 'Wajib Isi!!',
            ]);
            if (Request()->role_img <> "") {
                $file = Request()->role_img;
                $fileName = Request()->id . '.' . $file->extension();
                $file->move(public_path('role'), $fileName);

                $update_data = [
                    'role_code' => Request()->role_code,
                    'role_name' => Request()->role_name,
                    'detail' => Request()->detail,
                    'role_img' => $fileName,
                ];
                $this->role->editData($id, $update_data);
            } else {

                $update_data = [
                    'role_code' => Request()->role_code,
                    'role_name' => Request()->role_name,
                    'detail' => Request()->detail,
                ];
                $this->role->editData($id, $update_data);
            }
            Alert::success('Sukses','Data berhasil Diperbaharui');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoleUser  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleUser $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleUser  $role
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->role->deleteData($id);
        DB::statement("ALTER TABLE roles AUTO_INCREMENT = 1;");
        Alert::success('Sukses','Data berhasil Dihapus');
        return redirect()->back();
    }
}
