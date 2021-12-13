<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Instance;
use Alert;

class AdminClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $klien= new Client;
        $klien->instance_id = $request->client_instance;
        $klien->name = $request->client_name;
        $klien->email = $request->client_email;
        $klien->password = bcrypt('default');
        $klien->phone_number = $request->client_phone_number;
        $klien->save();
        // DB::statement("ALTER TABLE `clients` AUTO_INCREMENT = 1;");
        Alert::success('Sukses','Data berhasil ditambahkan');
        return redirect('/admin/proyek');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('pages.admin.client.detail', [
            'klien'=>$client,
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
        return redirect('/admin/client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
