<?php

namespace App\Http\Controllers;


use Alert;
use App\Models\Meeting;
use Illuminate\Http\Request;

class AdminMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.manajemen.mmeeting',[
            'meetingpending'=>Meeting::where('status_pertemuan','MENUNGGU VERIFIKASI')->get(),
            'meetingdisetujui'=>Meeting::where('status_pertemuan','DISETUJUI')->get(),
            'meetingselesai'=>Meeting::where('status_pertemuan','SELESAI')->get(),
            'meetingditolak'=>Meeting::where('status_pertemuan','DITOLAK')->get(),
            'meetingdiputuskan'=>Meeting::where('status_pertemuan','<>','MENUNGGU VERIFIKASI')->get(),
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
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=[
            'status_pertemuan'=>$request->persetujuanadmin
        ];
        Meeting::where('id',$id)->update($data);
        Alert::success('Berhasil');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}
