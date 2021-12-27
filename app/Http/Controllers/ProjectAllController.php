<?php

namespace App\Http\Controllers;

use App\Models\ProfTask;
use App\Models\ProjectAll;
use App\Models\ProjectModel;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        return view('pages.admin.todo', [
            'project_task' => ProjectTask::all()->where('user_id', Auth::user()->id),
            'tasks' => Task::all(),
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
    public function edit(Request $req)
    {
    }

    public function addTags(Request $req)
    {
        // dd(count($this->projectTask->where(['user_id' => $req->user_id, 'project_id' => $req->project_id])->get()));
        // dd($req->tags[1]);
        $checkTask = $this->projectTask->where(['user_id' => $req->user_id, 'project_id' => $req->project_id])->pluck('task_id')->toArray();
        $req->validate([
            'tags' => 'required',
        ], [
            'tags.required' => 'Profesi Tidak Boleh Kosong!!',
        ]);
        $newTagsIds = array_map('intval', $req->tags);
        // dd($newProfIds);
        $compareDeleted = array_diff($checkTask,$newTagsIds);
        $compareNew = array_diff($newTagsIds,$checkTask);
        // dd($compareDeleted,$compareNew);
        
        foreach ($compareDeleted as $delete) {
            ProjectTask::where(['user_id'=>$req->user_id, 'project_id' => $req->project_id,'task_id' => $delete])->delete();
        }
        foreach ($compareNew as $new) {
            ProjectTask::create([
                'user_id'=>$req->user_id, 'project_id' => $req->project_id,'task_id' => $new
            ]);
        }

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
    public function update(Request $request, ProjectAll $projectAll)
    {
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
}
