<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Client;
use App\Models\Instance;
use App\Models\ProjectModel;
use App\Models\InstancesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstanceController extends Controller
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
        return view('pages.admin.instansi.overview',[
            'instance'=>Instance::all(),
            'jenisinstansi'=>InstancesModel::all()
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
        $data = new Instance;
        $data->nama_instansi = $request->instance_name;
        $data->alamat_instansi = $request->instance_address;
        $data->kota_instansi = $request->instance_city;
        $data->instances_model_id = $request->instance_model;
        // if($request->file('instance_logo')){
        //     $data->logo_instansi = $request->file('instance_logo')->store('logoinstansi', ['disk' => 'public']);
        // }
        if ($request->instance_logo) {
            $jumlah = Instance::count();
            $jumlah = $jumlah+1;
            $file = $request->instance_logo;
            $fileName = 'logo'.$jumlah. '.' . $file->extension();
            $file->move(public_path('logoinstansi'), $fileName);
            $data->logo_instansi = $fileName;
        }
        $data->save();
        Alert::success('Sukses','Data Instansi Berhasil Ditambahkan');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function show(Instance $instansi)
    {
        if (Auth::user()->privilege != 1){
            return redirect('admin');
        }
        return view( 'pages.admin.instansi.detail', [
            'instance'=>$instansi,
            'jenis'=>InstancesModel::all(),
            'proyekinstansi'=>ProjectModel::where('instance_id',$instansi->id)->get(),
            'klieninstansi'=>Client::where('instance_id',$instansi->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function edit(Instance $instansi)
    {
        if (Auth::user()->privilege != 1){
            return redirect('admin');
        }
        return view( 'pages.admin.instansi.edit', [
            'instance'=>$instansi,
            'jenis'=>InstancesModel::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instance $instansi)
    {
        if($request->logoinstansi<> ""){
            $file = $request->logoinstansi;
            $fileName = 'logo'.$instansi->id. '.' . $file->extension();
            $file->move(public_path('logoinstansi'), $fileName);

            $data = [
                'nama_instansi' => $request->namainstansi,
                'alamat_instansi' => $request->alamatinstansi,
                'kota_instansi' => $request->kotainstansi,
                'instances_model_id' => $request->jenisinstansi,
                'logo_instansi' => $fileName
            ];
            Instance::where('id',$instansi->id)->update($data);
        }
        else{
            $data = [
                'nama_instansi' => $request->namainstansi,
                'alamat_instansi' => $request->alamatinstansi,
                'kota_instansi' => $request->kotainstansi,
                'instances_model_id' => $request->jenisinstansi,
            ];
            Instance::where('id',$instansi->id)->update($data);
        }
        // DB::statement("ALTER TABLE `projects` AUTO_INCREMENT = 1;");
        Alert::success('Sukses', 'Data berhasil di Update');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instansi)
    {
        Instance::destroy('id',$instansi->id);
        Alert::success('Sukses','Data Berhasil Dihapus');
        return redirect()->back();
    }
}
