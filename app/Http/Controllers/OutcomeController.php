<?php

namespace App\Http\Controllers;

use App\Models\OutcomeModel;
use Illuminate\Http\Request;

class OutcomeController extends Controller
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
        return view('pages.progress.out_create');
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
            'outcomeCode' => 'required',
            'outcomeName' => 'required',
            'outcomeDate' => 'required',
            //'outcomeCategory' => 'required',
            'outcomeProject' => 'required',
            'outcomeBalance' => 'required',
            'outcomeValue' => 'required',
            //'outcomeNota' => 'mimes:jpg,png,jpeg,bmp|max:1024|required',
        ], [
            'outcomeCode.required' => 'Wajib diisi!!',
            'outcomeName.required' => 'Wajib diisi!!',
            'outcomeDate.required' => 'Wajib diisi!!',
            //'outcomeCategory.required' => 'Wajib diisi!!',
            'outcomeProject.required' => 'Wajib diisi!!',
            'outcomeBalance.required' => 'Wajib dipilih!!',
            'outcomeValue.required' => 'Wajib diisi!!',
            //'outcomeNota.required' => 'Wajib diisi!!',
        ]);
        $data = new outcomeModel;
        $data->nama_pengeluaran = $request->outcomeCode;
        $data->kode_pengeluaran = $request->outcomeName;
        $data->tanggal_pengeluaran = $request->outcomeDate;
        //$data->kategori_pengeluaran = $request->outcomeCategory;
        $data->jenis_pengeluaran = $request->outcomeProject;
        $data->tujuan_pengeluaran = $request->outcomeBalance;
        $data->nominal_pengeluaran = $request->outcomeValue;
        //$data->keterangan_pengeluaran = $request->outcomeDetail;
        //$data->nota_pengeluaran = $request->outcomeNota;
        $data->save();
        DB::statement("ALTER TABLE `projects` AUTO_INCREMENT = 1;");
        Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
        return redirect('/admin/manage/finance');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutcomeModel  $outcomeModel
     * @return \Illuminate\Http\Response
     */
    public function show(OutcomeModel $outcomeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutcomeModel  $outcomeModel
     * @return \Illuminate\Http\Response
     */
    public function edit(OutcomeModel $outcomeModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutcomeModel  $outcomeModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutcomeModel $outcomeModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutcomeModel  $outcomeModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutcomeModel $outcomeModel)
    {
        //
    }
}
