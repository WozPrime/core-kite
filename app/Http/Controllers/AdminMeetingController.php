<?php

namespace App\Http\Controllers;


use Alert;
use App\Models\Meeting;
use App\Models\User;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->privilege != 1){
            return redirect('admin');
        }
        return view('pages.admin.manajemen.mmeeting',[
            'meetingpending'=>Meeting::where('status_pertemuan','MENUNGGU VERIFIKASI')->get(),
            'meetingdisetujui'=>Meeting::where('status_pertemuan','DISETUJUI')->get(),
            'meetingselesai'=>Meeting::where('status_pertemuan','SELESAI')->get(),
            'meetingditolak'=>Meeting::where('status_pertemuan','DITOLAK')->get(),
            'meetingdiputuskan'=>Meeting::where('status_pertemuan','<>','MENUNGGU VERIFIKASI')->get(),
            'karyawan'=>User::where('role','<>','client')->orderBy('name')->get(),
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
        $meeting = new Meeting;
        $meeting->project_id = $request->pilihproyek;
        $meeting->client_id = $request->idklien;
        $meeting->tanggal_pertemuan = $request->tanggalpertemuan;
        $meeting->deskripsi_pertemuan = $request->deskripsipertemuan;
        $meeting->status_pertemuan =  $request->persetujuanadmin;
        $meeting->catatan_admin =  $request->catatanadmin;
        $meeting->sistem_analis =  $request->analispertemuan;
        $meeting->hasil_pertemuan =  $request->hasilpertemuan;
        $meeting->save();
        Alert::success('Jadwal Berhasil Ditambahkan');
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
            'status_pertemuan'=>$request->persetujuanadmin,
            'catatan_admin'=>$request->catatanadmin,
            'hasil_pertemuan'=>$request->hasilpertemuan,
            'sistem_analis'=>$request->analispertemuan,
        ];
        Meeting::where('id',$id)->update($data);
        if($request->nilaiproyek){
            $total=[
                'project_value'=>$request->nilaiproyek,
            ];
            ProjectModel::where('id',$request->idproyek)->update($total);
        }
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
