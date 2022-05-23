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

    public function __construct(ProjectAll $projectAll, User $user, ProjectTask $projectTask, ProjectModel $project, Task $task,Doc $doc)
    {
        // İnitialize user property.
        $this->projectAll = $projectAll;
        $this->user = $user;
        $this->projectTask = $projectTask;
        $this->project = $project;
        $this->task = $task;
        $this->doc = $doc;
    }
    public function index()
    {
        $pt =  ProjectTask::all()->where('user_id', Auth::user()->id);
        return view('pages.admin.todo', [
            'project_task' => $pt->where('status','<',2)->where('start_at','<=', Carbon::now()),
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
        $projectAll = $this->projectAll;
        $Doc = $this->doc;
        return view('pages.admin.manajemen.mtask', compact('projectTask', 'Task', 'User', 'Project','projectAll','Doc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectAll  $projectAll
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $req)
    {
        $ptask = $this->projectTask->find($id);
        if($req->start_at > $req->expired_at){
            $temp  = $req->start_at;
            $req->start_at = $req->expired_at;
            $req->expired_at = $temp;
        }
        $req->validate([
            'expired_at' => 'required',
            'start_at' => 'required',
            'user_id' => 'required',
            'task_id' => 'required',
            'details' => 'required',
        ], [
            'expired_at.required' => 'Tanggal Tidak Boleh Kosong!!',
            'start_at.required' => 'Tanggal Tidak Boleh Kosong!!',
            'user_id.required' => 'User Tidak Boleh Kosong!!',
            'task_id.required' => 'Task Tidak Boleh Kosong!!',
            'details.required' => 'Detail Tidak Boleh Kosong!!',
        ]);
        if (
            $req->user_id == $ptask->user_id &&
            $req->task_id == $ptask->task_id &&
            $req->details == $ptask->details &&
            strtotime($req->expired_at) == strtotime($ptask->expired_at) &&
            strtotime($req->start_at) == strtotime($ptask->start_at)  
        ){
            Alert::warning('Sama', 'Data Tidak Berubah');
            return redirect('/admin/manage/project_all');
        } else
        {
            if (($ptask->status == 1 || $ptask->status == 2) && $req->user_id != $ptask->user_id) {
                Alert::warning('Peringatan', 'Tugas Karyawan Tidak Bisa Dipindahkan karena Karyawan Sudah Mengupload atau Tugas Sudah Dinilai');
                return redirect('/admin/manage/project_all');
            } elseif(($ptask->status == 3) && $req->user_id != $ptask->user_id) {
                $this->projectTask->find($id)->update([
                    'expired_at' => $req->expired_at,
                    'start_at' => $req->start_at,
                    'user_id' => $req->user_id,
                    'task_id' => $req->task_id,
                    'details' => $req->details,
                    'status' => null,
                ]);
                Alert::success('Sukses', 'Tugas Berhasil Diperbaharui!!!');
                return redirect()->back();
            } else{
                $this->projectTask->find($id)->update([
                    'expired_at' => $req->expired_at,
                    'start_at' => $req->start_at,
                    'user_id' => $req->user_id,
                    'task_id' => $req->task_id,
                    'details' => $req->details,
                ]);
                Alert::success('Sukses', 'Tugas Berhasil Diperbaharui!!!');
                return redirect()->back();
            }
        }
        
    }

    public function addTags(Request $req)
    {
        // dd(count($this->projectTask->where(['user_id' => $req->user_id, 'project_id' => $req->project_id])->get()));
        // // dd($req->tags[1]);
        // $checkTask = $this->projectTask->where(['user_id' => $req->user_id, 'project_id' => $req->project_id])->pluck('task_id')->toArray();
        // dd($checkTask);
        if($req->start_at > $req->expired_at){
            $temp  = $req->start_at;
            $req->start_at = $req->expired_at;
            $req->expired_at = $temp;
        }
        $req->validate([
            'task_id' => 'required',
            'details' => 'required',
            'expired_at' => 'required',
            'start_at' => 'required',
        ], [
            'task_id.required' => 'Task Tidak Boleh Kosong!!',
            'details.required' => 'Detail Tidak Boleh Kosong!!',
            'start_at.required' => 'Tanggal Tidak Boleh Kosong!!',
            'expired_at.required' => 'Deadline Tidak Boleh Kosong!!',
        ]);
        ProjectTask::create([
                    'user_id'=>$req->user_id, 
                    'project_id' => $req->project_id,
                    'task_id' => $req->task_id,
                    'details' => $req->details,
                    'expired_at' => $req->expired_at,
                    'start_at' => $req->start_at,
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
        $data = ProjectModel::find($req->project_id);
        $data = [
        'project_status' => "Dalam Pengerjaan",
        ];
        ProjectModel::where('id', $req->project_id)->update($data);
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

    public function deleteFile(Request $req)
    {
        $file_name = $req->file_name;
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
