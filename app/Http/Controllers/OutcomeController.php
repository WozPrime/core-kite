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
        return view('pages.progress.outcome');
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
