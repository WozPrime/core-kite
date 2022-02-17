<?php

namespace App\Http\Controllers;

use App\Models\IncomeModel;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        Request()->validate([
            'incomeCode' => 'required',
            'incomeName' => 'required',
            'incomeDate' => 'required',
            //'incomeCategory' => 'required',
            'incomeProject' => 'required',
            'incomeBalance' => 'required',
            'incomeValue' => 'required',
            //'incomeNota' => 'mimes:jpg,png,jpeg,bmp|max:1024|required',
        ], [
            'incomeCode.required' => 'Wajib diisi!!',
            'incomeName.required' => 'Wajib diisi!!',
            'incomeDate.required' => 'Wajib diisi!!',
            //'incomeCategory.required' => 'Wajib diisi!!',
            'incomeProject.required' => 'Wajib diisi!!',
            'incomeBalance.required' => 'Wajib dipilih!!',
            'incomeValue.required' => 'Wajib diisi!!',
            //'incomeNota.required' => 'Wajib diisi!!',
        ]);
        $data = new IncomeModel;
        $data->nama_pemasukan = $request->incomeCode;
        $data->kode_pemasukan = $request->incomeName;
        $data->tanggal_pemasukan = $request->incomeDate;
        //$data->kategori_pemasukan = $request->incomeCategory;
        $data->jenis_pemasukan = $request->incomeProject;
        $data->tujuan_pemasukan = $request->incomeBalance;
        $data->nominal_pemasukan = $request->incomeValue;
        //$data->keterangan_pemasukan = $request->incomeDetail;
        //$data->nota_pemasukan = $request->incomeNota;
        $data->save();
        DB::statement("ALTER TABLE `projects` AUTO_INCREMENT = 1;");
        Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
        return redirect('/admin/manage/finance');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomeModel  $incomeModel
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeModel $incomeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomeModel  $incomeModel
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeModel $incomeModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncomeModel  $incomeModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncomeModel $incomeModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomeModel  $incomeModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeModel $incomeModel)
    {
        //
    }
}
