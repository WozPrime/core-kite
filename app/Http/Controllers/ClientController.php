<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Instance;
use App\Models\User;
use App\Models\ProjectModel;
use App\Models\Payment;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klien=Client::where('user_id',auth()->user()->id)->first();
        return view ('pages.klien.index',[
            'klien'=>$klien,
            'proyek'=>ProjectModel::where('client_id',$klien->id)->get(),
            'pembayaran'=>Payment::where('user_id',$klien->id)->orderBy('updated_at','DESC')->get(),
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
}
