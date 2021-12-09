<?php

namespace App\Http\Controllers;

use App\Models\JobData;
use Illuminate\Http\Request;
use App\Models\Post;
use RealRashid\SweetAlert\Facades\Alert;

class JobDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('pages.admin.todo',[
            'jobdata'=>Jobdata::all(),
            'posts'=>Post::all(),
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
        $data = new JobData;
        $data->users_id = $request->users_id;
        $data->project_id = $request->project_id;
        $data->save();
        Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!'); 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobData  $jobData
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobData  $jobData
     * @return \Illuminate\Http\Response
     */
    public function edit(JobData $jobData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobData  $jobData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobData $jobData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobData  $jobData
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobData $jobData)
    {
        //
    }
}
