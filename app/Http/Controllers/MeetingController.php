<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $meeting = new Meeting;
        $meeting->project_id = $request->pilihproyek;
        $meeting->client_id = $request->idklien;
        $meeting->tanggal_pertemuan = $request->tanggalpertemuan;
        $meeting->tempat_pertemuan = $request->tempatpertemuan;
        $meeting->deskripsi_pertemuan = $request->deskripsipertemuan;
        $meeting->status_pertemuan =  'MENUNGGU VERIFIKASI';
        $meeting->save();
        Alert::success('Jadwal Berhasil Diajukan');
        return redirect()->back();
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
            'tanggal_pertemuan' => $request->tanggalpertemuan,
            'deskripsi_pertemuan' => $request->deskripsipertemuan,
            'project_id'=>$request->pilihproyek,
            'status_pertemuan'=>'MENUNGGU VERIFIKASI',
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
    public function destroy($id)
    {
        Meeting::destroy('id',$id);
        Alert::success('Data Berhasil Dihapus');
        return redirect()->back();
    }
}
