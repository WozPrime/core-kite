<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\FiCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = new FiCategoryModel;
        $data->jenis_kategori = $request->jenis_kategori;
        $data->nama_kategori = $request->nama_kategori;
        $data->save();
        Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FiCategoryModel  $fiCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function show(FiCategoryModel $fiCategoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FiCategoryModel  $fiCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(FiCategoryModel $fiCategoryModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FiCategoryModel  $fiCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = FiCategoryModel::find($id);
        if(
            Request()->jenis_kategori == $data->jenis_kategori &&
            Request()->nama_kategori == $data->nama_kategori
        ) {
            Alert::warning('Sama', 'Data Tidak Berubah');
            return redirect()->back();
        }
        else {
            $data->jenis_kategori = $request->jenis_kategori;
            $data->nama_kategori = $request->nama_kategori;
            $data->save();
            Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FiCategoryModel  $fiCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(FiCategoryModel $fiCategoryModel)
    {
        //
    }
}
