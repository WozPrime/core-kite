<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use App\Models\ProfTask;
use App\Models\ProjectAll;
use App\Models\ProjectModel;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File; 
class ProjectAllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(ProjectAll $projectAll, User $user, ProjectTask $projectTask, ProjectModel $project, Task $task)
    {
        // İnitialize user property.
        $this->projectAll = $projectAll;
        $this->user = $user;
        $this->projectTask = $projectTask;
        $this->project = $project;
        $this->task = $task;
    }
    public function index()
    {
        $pt =  ProjectTask::all()->where('user_id', Auth::user()->id);
        return view('pages.admin.todo', [
            'project_task' => $pt->where('status','<',2),
            'tasks' => Task::all(),
            'file_task' => Doc::all(),
            'task_list' => $pt->where('status', '>=',2),
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
    public function store(Request $req)
    {
        $req->validate([
            'profs' => 'required',
        ], [
            'profs.required' => 'Profesi Tidak Boleh Kosong!!',
        ]);
        $checkProf = $this->projectAll->where(['user_id' => $req->user_id, 'project_id' => $req->project_id])->pluck('prof_id')->toArray();
        $newProfIds = array_map('intval', $req->profs);
        // dd($newProfIds);
        $compareDeleted = array_diff($checkProf,$newProfIds);
        $compareNew = array_diff($newProfIds,$checkProf);
        // dd($compareDeleted,$compareNew);
        
        foreach ($compareDeleted as $delete) {
            ProjectAll::where(['user_id'=>$req->user_id, 'project_id' => $req->project_id,'prof_id' => $delete])->delete();    
            $deleteTask = ProfTask::where('prof_id',$delete)->pluck('task_id')->toArray();
            foreach ($deleteTask as $delTask) {
                ProjectTask::where(['user_id'=>$req->user_id, 'project_id' => $req->project_id,'task_id' => $delTask])->delete();
            }
        }
        foreach ($compareNew as $new) {
            ProjectAll::create([
                'user_id'=>$req->user_id, 'project_id' => $req->project_id,'prof_id' => $new
            ]);
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
        $projectTask = $this->projectTask;
        $Task = $this->task;
        $User = $this->user;
        $Project = $this->project;
        return view('pages.admin.manajemen.mtask', compact('projectTask', 'Task', 'User', 'Project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectAll  $projectAll
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $req)
    {
        $req->validate([
            'expired_at' => 'required',
        ], [
            'expired_at.required' => 'Profesi Tidak Boleh Kosong!!',
        ]);
        $this->projectTask->find($id)->update([
            'expired_at' => $req->expired_at,
        ]);
        Alert::success('Sukses', 'Tugas Berhasil Ditambahkan!!!');
        return redirect()->back();
        
    }

    public function addTags(Request $req)
    {
        // dd(count($this->projectTask->where(['user_id' => $req->user_id, 'project_id' => $req->project_id])->get()));
        // // dd($req->tags[1]);
        // $checkTask = $this->projectTask->where(['user_id' => $req->user_id, 'project_id' => $req->project_id])->pluck('task_id')->toArray();
        // dd($checkTask);
        $req->validate([
            'task_id' => 'required',
            'details' => 'required',
            'expired_at' => 'required',
        ], [
            'task_id.required' => 'Task Tidak Boleh Kosong!!',
            'details.required' => 'Detail Tidak Boleh Kosong!!',
            'expired_at.required' => 'Deadline Tidak Boleh Kosong!!',
        ]);
        ProjectTask::create([
                    'user_id'=>$req->user_id, 
                    'project_id' => $req->project_id,
                    'task_id' => $req->task_id,
                    'details' => $req->details,
                    'expired_at' => $req->expired_at,
                ]);
        // $newTagsIds = array_map('intval', $req->tags);
        // // dd($newProfIds);
        // $compareDeleted = array_diff($checkTask,$newTagsIds);
        // $compareNew = array_diff($newTagsIds,$checkTask);
        // // dd($compareDeleted,$compareNew);
        
        // foreach ($compareDeleted as $delete) {
        //     ProjectTask::where(['user_id'=>$req->user_id, 'project_id' => $req->project_id,'task_id' => $delete])->delete();
        // }
        // foreach ($compareNew as $new) {
        //     ProjectTask::create([
        //         'user_id'=>$req->user_id, 'project_id' => $req->project_id,'task_id' => $new
        //     ]);
        // }

        Alert::success('Sukses', 'Tugas Berhasil Ditambahkan!!!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectAll  $projectAll
     * @return \Illuminate\Http\Response
     */
    public function file_move(Request $request,$id)
    {
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $uploadedFile = $file->move(public_path('files/task/'),$fileName);
        ProjectTask::find($id)->update([
            'post_date' => Carbon::now(),
        ]);
        $newDoc = new Doc;
        $newDoc->pt_id = $id;
        $newDoc->file_name = $fileName;
        $newDoc->save();

        return response()->json(['success'=>$uploadedFile]);
    }

    public function upload_details($id,Request $req)
    {   
        $req->validate([
            'upload_details' => 'required',
        ],[
            'upload_details.required' => 'Keterangan Upload Tidak Boleh Kosong!!!!',
        ]);
        
        if (Doc::where('pt_id',$id)->exists()) {
            ProjectTask::find($id)->update([
                'upload_details' => $req->upload_details,
                'post_date' => Carbon::now(),
                'status' => 1,
            ]);
    
            Alert::success('Sukses', 'Upload Tugas Berhasil!!!');
        }else{
            Alert::warning('Peringatan', 'Upload Dokumen terlebih dahulu!!!');
        }
        
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectAll  $projectAll
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProjectAll::where('user_id', $id)->delete();
        ProjectTask::where('user_id', $id)->delete();
        Alert::success('Sukses', 'Data Proyek berhasil dihapus!');
        return redirect()->back();
    }

    public function deleteTask($id)
    {
        ProjectTask::find($id)->delete();
        Alert::success('Sukses', 'Task berhasil dihapus!');
        return redirect()->back();
    }

    public function deleteFile($file_name)
    {
        $pt_id =  Doc::where('file_name',$file_name)->first()->pt_id;
        $file_path = public_path().'/files/task/'.$file_name;
        File::delete($file_path);
        Doc::where('file_name',$file_name)->delete();
        if(Doc::where('pt_id',$pt_id)->count() == 0){
            ProjectTask::find($pt_id)->update([
                'upload_details' => null,
                'post_date' => null,
                'status' => null,
            ]);
        }
        Alert::success('Sukses', 'Task berhasil dihapus!');
        return redirect()->back();
    }
}
