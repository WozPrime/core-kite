<?php

namespace App\Http\Controllers;

use App\Models\EmpReport;
use App\Models\ReportModel;
use Illuminate\Http\Request;

class EmpReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function index()
    {
        return view('pages.emp.empreport', [
            'data' => ReportModel::all()
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
     * @param  \App\Models\EmpReport  $empReport
     * @return \Illuminate\Http\Response
     */
    public function show(EmpReport $empReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpReport  $empReport
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpReport $empReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpReport  $empReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpReport $empReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpReport  $empReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpReport $empReport)
    {
        //
    }
}
