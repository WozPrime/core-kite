<?php

namespace App\Http\Controllers;

use App\Models\EmpModel;
use Illuminate\Http\Request;

class EmpController extends Controller
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
        return view('pages.emp.emp');
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
     * @param  \App\Models\EmpModel  $empModel
     * @return \Illuminate\Http\Response
     */
    public function show(EmpModel $empModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpModel  $empModel
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpModel $empModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpModel  $empModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpModel $empModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpModel  $empModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpModel $empModel)
    {
        //
    }

    // non-resource
    // public function profile()
    // {   
    //     $id= Auth::user()->id;
    //     $data_user = User::find($id);
    //     $prof_list = Prof::all();
    //     return view('pages.emp.empprofile');
    // }
}
