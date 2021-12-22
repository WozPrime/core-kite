<?php

namespace App\Http\Controllers;

use App\Models\ProjectAll;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectAllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(ProjectAll $projectAll, User $user, ProjectTask $projectTask)
    {
        // İnitialize user property.
        $this->projectAll = $projectAll;
        $this->user = $user;
        $this->projectTask = $projectTask;
    }
    public function index()
    {   
        return view('pages.admin.todo',[
            'project_all'=>ProjectAll::all(),
            'tasks'=>Task::all(),
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
        $request->validate([
            'prof_id' => 'required',
        ], [
            'prof_id.required' => 'Profesi Tidak Boleh Kosong!!',
        ]);
        $checkProf =$this->projectAll->where('user_id',$request->user_id);
        // dd($checkProf);
        if ($checkProf->first()->prof_id == ''){
            $checkProf->update([
                'prof_id' => $request->prof_id,
            ]);
        }else {
            $data = new ProjectAll;
            $data->user_id = $request->user_id;
            $data->project_id = $request->project_id;
            $data->prof_id = $request->prof_id;
            $data->save();
        }
        Alert::success('Sukses', 'Data Proyek berhasil ditambahkan!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectAll  $projectAll
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectAll  $projectAll
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        
    }

    public function addTags(Request $req)
    {
        // dd(count($this->projectTask->where(['user_id' => $req->user_id, 'project_id' => $req->project_id])->get()));
        // dd($req->tags[1]);
        $checkTask = $this->projectTask->where(['user_id' => $req->user_id, 'project_id' => $req->project_id]);
        $req->validate([
            'tags' => 'required',
        ], [
            'tags.required' => 'Profesi Tidak Boleh Kosong!!',
        ]);
        if(count($checkTask->get()) == 0){
            foreach ($req->tags as $tag) {
                $this->projectTask->create([
                    'user_id' => $req->user_id,
                    'project_id' => $req->project_id,
                    'task_id' => $tag,
                ]);
            }
        }
        elseif (count($req->tags) <= count($checkTask->get())){
            // dd(count($checkTask->get()));
            // dd(count($req->tags));
            $id = $checkTask->get()->first()->id;
            for ($i=0; $i < count($req->tags); $i++){
                $this->projectTask->find($id+$i)->update([
                    'user_id' => $req->user_id,
                    'project_id' => $req->project_id,
                    'task_id' => $req->tags[$i],
                ]);
            }
        } else {
            $id = $checkTask->get()->first()->id;
            for ($i=0; $i < count($req->tags); $i++){
                if ($i < count($checkTask->get())){
                    $this->projectTask->find($id+$i)->update([
                        'user_id' => $req->user_id,
                        'project_id' => $req->project_id,
                        'task_id' => $req->tags[$i],
                    ]);
                } else{
                    $this->projectTask->create([
                        'user_id' => $req->user_id,
                        'project_id' => $req->project_id,
                        'task_id' => $req->tags[$i],
                    ]);
                }
            }
        }
        Alert::success('Sukses','Tugas Berhasil Ditambahkan!!!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectAll  $projectAll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectAll $projectAll)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectAll  $projectAll
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectAll $projectAll)
    {
        //
    }
}
