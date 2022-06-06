<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        $data = new Payment;
        $data->user_id = $request->userpembayaran;
        $data->project_id = $request->proyekpembayaran;
        $data->tanggal_pembayaran = $request->tanggalpembayaran;
        $data->jenis_pembayaran = $request->jenispembayaran;
        $data->deskripsi_pembayaran = $request->deskripsipembayaran;
        $data->nilai_pembayaran = $request->nilaipembayaran;
        $data->save();
        Alert::success('Sukses', 'Data Pembayaran Berhasil Ditambahkan');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $data=[
            'tanggal_pembayaran'=>$request->tanggalpembayaran,
            'jenis_pembayaran'=>$request->jenispembayaran,
            'deskripsi_pembayaran'=>$request->deskripsipembayaran,
            'nilai_pembayaran'=>$request->nilaipembayaran,
        ];
        Payment::where('id',$payment->id)->update($data);
        Alert::success('Data berhasil di edit');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        Payment::destroy('id',$payment->id);
        Alert::success('Sukses', 'Data Pembayaran Berhasil Dihapus');
        return redirect()->back();
    }
}
