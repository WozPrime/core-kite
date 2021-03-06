<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Payment;
use App\Models\ProjectModel;
use App\Models\Instance;
use App\Models\User;
use App\Models\Meeting;
use Alert;
use Illuminate\Support\Facades\Auth;

class AdminClientController extends Controller
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
        return view('pages.admin.client.overview',[
            'client'=>Client::all(),
            'instansi'=>Instance::all()
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

        $klienuser= new User;
        $klienuser->name = $request->client_name;
        $klienuser->email =  $request->client_email;
        $klienuser->password = bcrypt('default');
        $klienuser->role = 'client';
        $klienuser->save();
        
        $k= User::where('name',$request->client_name)->first(); 
        $klien= new Client;
        $klien->instance_id = $request->client_instance;
        $klien->name = $request->client_name;
        $klien->email = $request->client_email;
        $klien->password = bcrypt('default');
        $klien->phone_number = $request->client_phone_number;
        $klien->user_id = $k->id;
        $klien->save();
        // DB::statement("ALTER TABLE `clients` AUTO_INCREMENT = 1;");
        Alert::success('Sukses','Data berhasil ditambahkan');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        if (Auth::user()->privilege != 1){
            return redirect('admin');
        }
        return view('pages.admin.client.detail', [
            'klien'=>$client,
            'pembayaranklien'=>Payment::where('user_id', $client->id)->get(),
            'projekklien'=>ProjectModel::where('client_id', $client->id)->get(),
            'meetingklien'=>Meeting::where('client_id',$client->id)->get(),
            'karyawan'=>User::where('role','<>','client')->orderBy('name')->get(),
            'klienuser'=>User::where('id',$client->user_id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= [
            'instance_id'=>$request->client_instance,
            'name'=>$request->nama_klien,
            'email'=>$request->email_klien,
            'phone_number'=>$request->nomor_klien
        ];
        
        Client::where('id',$id)->update($data);
        Alert::success('Sukses', 'Data Berhasil Diperbarui');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $klien=Client::where('id',$id)->first();
        User::destroy('id',$klien->user_id);
        Client::destroy('id',$id);
        Alert::success('Sukses','Data Berhasil Dihapus');
        return redirect('/admin/client');
    }
}
