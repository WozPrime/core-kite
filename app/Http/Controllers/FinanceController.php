<?php

namespace App\Http\Controllers;

use App\Models\FinanceModel;
use App\Models\IncomeModel;
use App\Models\OutcomeModel;
use Illuminate\Http\Request;

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
            'indata' => IncomeModel::all(),
            'outdata' => OutcomeModel::all(),
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
        //
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
    public function update(Request $request, FinanceModel $financeModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinanceModel  $financeModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinanceModel $financeModel)
    {
        //
    }
}
