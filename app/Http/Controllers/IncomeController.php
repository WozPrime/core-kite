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
        return view('pages.progress.income');
        //,[
        //    'client'=>Client::all(),
        //    'instansi'=>Instance::all()
        //]);
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
