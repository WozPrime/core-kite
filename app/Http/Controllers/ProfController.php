<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Prof $prof)
    {
        // İnitialize user property.
        $this->prof = $prof;
    }

    public function index()
    {
        $prof_list = Prof::all();
        return view('pages.admin.mprof', compact('prof_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Request()->validate([
                'prof_code' => 'required|unique:profs,prof_code,'.Request()->id,
                'prof_name' => 'required',
                'prof_img' => 'mimes:jpg,png,jpeg,bmp|max:5120',
            ], [
                'prof_code.required' => 'Wajib Isi!!',
                'prof_name.required' => 'Wajib Isi!!',
            ]);
            if (Request()->prof_img <> "") {
                $file = Request()->prof_img;
                $fileName = Request()->id . '.' . $file->extension();
                $file->move(public_path('prof'), $fileName);

                $insert_data = [
                    'prof_code' => Request()->prof_code,
                    'prof_name' => Request()->prof_name,
                    'detail' => Request()->detail,
                    'prof_img' => $fileName,
                ];
                $this->prof->insertData($insert_data);
            } else {

                $insert_data = [
                    'prof_code' => Request()->prof_code,
                    'prof_name' => Request()->prof_name,
                    'detail' => Request()->detail,
                ];
                $this->prof->insertData($insert_data);
            }
            return redirect()->back()->with('pesan', 'Data Berhasil Ditambahkan!!!');
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
     * @param  \App\Models\Prof  $prof
     * @return \Illuminate\Http\Response
     */
    public function show(Prof $prof)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prof  $prof
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_prof = $this->prof->find($id);
        if (Request()->prof_code == $data_prof->prof_code &&
        Request()->prof_name == $data_prof->prof_name &&
        Request()->detail == $data_prof->detail &&
        Request()->prof_img == ""
        ) {
            return redirect()->back()->with('sama','Data Tidak Berubah!!');
        } else {
            Request()->validate([
                'prof_code' => 'required|unique:profs,prof_code,'.Request()->id,
                'prof_name' => 'required',
                'prof_img' => 'mimes:jpg,png,jpeg,bmp|max:5120',
            ], [
                'prof_code.required' => 'Wajib Isi!!',
                'prof_name.required' => 'Wajib Isi!!',
            ]);
            if (Request()->prof_img <> "") {
                $file = Request()->prof_img;
                $fileName = Request()->id . '.' . $file->extension();
                $file->move(public_path('prof'), $fileName);

                $update_data = [
                    'prof_code' => Request()->prof_code,
                    'prof_name' => Request()->prof_name,
                    'detail' => Request()->detail,
                    'prof_img' => $fileName,
                ];
                $this->prof->editData($id, $update_data);
            } else {

                $update_data = [
                    'prof_code' => Request()->prof_code,
                    'prof_name' => Request()->prof_name,
                    'detail' => Request()->detail,
                ];
                $this->prof->editData($id, $update_data);
            }
            return redirect()->back()->with('pesan', 'Data Berhasil Diperbaharui!!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prof  $prof
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prof $prof)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prof  $prof
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->prof->deleteData($id);
        DB::statement("ALTER TABLE profs AUTO_INCREMENT = 1;");
        return redirect()->back()->with('pesan', 'Data Berhasil Dihapus!!!');
    }
}
