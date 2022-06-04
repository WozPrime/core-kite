<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Client;
use App\Models\ProjectTask;
use App\Models\Instance;
use App\Models\User;
use App\Models\Meeting;
use App\Models\ProjectModel;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        if (Auth::user()->role == 'member') {
            return redirect('emp');
        }
        $klien=Client::where('user_id',auth()->user()->id)->first();
        $meetingklien = Meeting::where('client_id',$klien->id)->get();
        return view ('pages.klien.index',[
            'klien'=>$klien,
            'proyek'=>ProjectModel::where('client_id',$klien->id)->where('project_status','<>','Selesai')->get(),
            'pselesai'=>ProjectModel::where('client_id',$klien->id)->where('project_status','Selesai')->get(),
            'pembayaran'=>Payment::where('user_id',$klien->id)->orderBy('updated_at','DESC')->get(),
            'proyekberjalan'=>ProjectModel::where('client_id',$klien->id)->where('project_status','Sedang Berjalan')->count(),
            'proyekselesai'=>ProjectModel::where('client_id',$klien->id)->where('project_status','Selesai')->count(),
            'proyektertunda'=>ProjectModel::where('client_id',$klien->id)->where('project_status','Tertunda')->count(),
            'meeting'=>$meetingklien,
            'meetingaktif' => Meeting::where('client_id',$klien->id)->where('status_pertemuan','diterima')->get(),
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function pilihan(Request $data)
    {
        $valueClient = Client::select('id', 'name')->where('instance_id', $data->id)->get();
        $this->message = 'Masuk';
        return json_encode($valueClient);
        // return response()->json([
        //     'message' => $data->id
        // ]);
    }

    public function gantipassword(Request $request, $id){
        $pasli = User::where('id',$id)->first();
        if(Hash::check ($request->plama,$pasli->password) ){
            // Alert::error('Password lama salah');
            // return redirect()->back();
            if($request->pulang == $request->pbaru){
                $data =[
                    'password'=>bcrypt($request->pbaru),
                ];
                User::where('id',$id)->update($data);
                Alert::success('Berhasil Mengganti Password');
                return redirect()->back();
            }
            else{
                Alert::error('Konfirmasi Password tidak sesuai');
                return redirect()->back();
            }
        }
        else{
            Alert::error('Password Lama Salah');
            return redirect()->back();
        }
    }

    public function gantipp(Request $request, $id){
        $file = $request->pp;
        $filename = 'profilepic'.$id. '.' . $file->extension();
            $file->move(public_path('pp'), $filename);

            $update = [
                'pp'=>$filename,
            ];
            User::where('id',$id)->update($update);
            Alert::success('Berhasil Mengganti Foto Profil');
            return redirect()->back();
    }

    public function projectdetail($id){
        if (Auth::user()->role == 'admin') {
            return redirect('admin');
        }
        if (Auth::user()->role == 'member') {
            return redirect('emp');
        }
        $klien=Client::where('user_id',auth()->user()->id)->first();
        $data=ProjectModel::where('id',$id)->first();
        if ($data->client_id != $klien->id) {
            Alert::error('FORBIDDEN');
            return redirect()->back();
        } 
        else {
            return view('pages.klien.clientproject',[
                'data' => ProjectModel::where('id',$id)->first(),
                'pembayaran' => Payment::where('project_id',$id)->get(),
                'ptask'=>ProjectTask::all(),
                'progress'=>ProjectTask::where('project_id',$id)->get(),
                'klien'=>$klien,
            ]);
        }
    }
}
