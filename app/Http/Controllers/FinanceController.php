<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\FinanceModel;
use App\Models\FiCategoryModel;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.progress.finance', [
            'finance' => FinanceModel::all(),
            'category' => FiCategoryModel::all(),
            'project' => ProjectModel::all(),
        ]);
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
        $file = $request->nota_finance;
        $fileName = 'logo' . '_' . Request()->name_finance . '.' . $file->extension();
        $file->move(public_path('notaFinansial'), $fileName);

        Request()->validate([
            'name_finance' => 'required',
            // 'code_finance' => 'required',
            'date_finance' => 'required',
            'category_finance' => 'required',
            'type_finance' => 'required',
            'nominal_finance' => 'required',
            'balance_finance' => 'required',
            'nota_finance' => 'required|mimes:jpg,png,jpeg,bmp|max:1024',
            'inout_finance' => 'required',
            'detail_finance' => 'required',
        ], [
            'name_finance.required' => 'Wajib diisi!!',
            // 'code_finance.required' => 'Wajib diisi!!',
            'date_finance.required' => 'Wajib diisi!!',
            'category_finance.required' => 'Wajib diisi!!',
            'type_finance.required' => 'Wajib diisi!!',
            'nominal_finance.required' => 'Wajib diisi!!',
            'nominal_finance.mimes' => 'Harus berupa file jpg, png, jpeg, atau bmp!!',
            'balance_finance.required' => 'Wajib diisi!!',
            'nota_finance.required' => 'Wajib diisi!!',
            'inout_finance.required' => 'Wajib diisi!!',
            'detail_finance.required' => 'Wajib diisi!!',
        ]);
        $data = new FinanceModel;
        $data->name_finance = $request->name_finance;
        // $data->code_finance = $request->code_finance;
        $data->date_finance = $request->date_finance;
        $data->category_finance = $request->category_finance;
        $data->type_finance = $request->type_finance;
        $data->nominal_finance = $request->nominal_finance;
        $data->balance_finance = $request->balance_finance;
        $data->inout_finance = $request->inout_finance;
        $data->detail_finance = $request->detail_finance;
        $data->nota_finance = $fileName;

        $data->save();
        if (Request()->inout_finance == "Pemasukan")
        {
            Alert::success('Sukses', 'Data Pemasukan berhasil ditambahkan!');
            return redirect()->back();
        }
        Alert::success('Sukses', 'Data Pengeluaran berhasil ditambahkan!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FinanceModel  $financeModel
     * @return \Illuminate\Http\Response
     */
    public function show(FinanceModel $financeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinanceModel  $financeModel
     * @return \Illuminate\Http\Response
     */
    public function edit(FinanceModel $financeModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinanceModel  $financeModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = FinanceModel::find($id);
        if (
            Request()->id == $data->id &&
            Request()->name_finance == $data->name_finance &&
            Request()->date_finance == $data->date_finance &&
            Request()->category_finance == $data->category_finance &&
            Request()->type_finance == $data->type_finance &&
            Request()->nominal_finance == $data->nominal_finance &&
            Request()->balance_finance == $data->balance_finance &&
            Request()->detail_finance == $data->detail_finance &&
            Request()->nota_finance == ""
        ) {
            Alert::warning('Sama', 'Data Tidak Berubah');
            return redirect()->back();
        }
        else {
            if($request->nota_finance <> ""){
                $file = $request->nota_finance;
                $fileName = 'logo' . '_' . Request()->name_finance . '.' . $file->extension();
                $file->move(public_path('notaFinansial'), $fileName);

                $data = [
                    'name_finance' => $request->name_finance,
                    'date_finance' => $request->date_finance,
                    'category_finance' => $request->category_finance,
                    'type_finance' => $request->type_finance,
                    'nominal_finance' => $request->nominal_finance,
                    'balance_finance' => $request->balance_finance,
                    'inout_finance' => $request->inout_finance,
                    'detail_finance' => $request->detail_finance,
                    'nota_finance' => $fileName,
                ];
            }
            else {
                $data = [
                'name_finance' => $request->name_finance,
                'date_finance' => $request->date_finance,
                'category_finance' => $request->category_finance,
                'type_finance' => $request->type_finance,
                'nominal_finance' => $request->nominal_finance,
                'balance_finance' => $request->balance_finance,
                'inout_finance' => $request->inout_finance,
                'detail_finance' => $request->detail_finance,
                ];
            }
            FinanceModel::where('id', $id)->update($data);
            if (Request()->inout_finance == "Pemasukan")
            {
                Alert::success('Sukses', 'Data Pemasukan berhasil diubah!');
                return redirect()->back();
            }
            Alert::success('Sukses', 'Data Pengeluaran berhasil diubah!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinanceModel  $financeModel
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        FinanceModel::destroy('id', $id);
        Alert::success('Sukses', 'Data Proyek berhasil dihapus!');
        return redirect()->back();
    }
}
