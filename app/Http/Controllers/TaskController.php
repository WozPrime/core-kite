<?php

namespace App\Http\Controllers;

use App\Models\RoleTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RoleUser;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
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

    public function __construct(Task $task)
    {
        // İnitialize user property.
        $this->task = $task;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Request()->validate([
            'code' => 'required|unique:tasks,code,'.Request()->id,
            'task_name' => 'required',
            'points' => 'required|integer',
            'role_id' => 'required',
        ], [
            'code.required' => 'Wajib Isi!!',
            'task_name.required' => 'Wajib Isi!!',
            'points.required' => 'Wajib Isi!!',
            'role_id.required' => 'Wajib Isi!!',
        ]);
        $create = $this->task->create([
            'code' => Request()->code,
            'task_name' => Request()->task_name,
            'points' => Request()->points,
        ]);
        $createId = $create->id;
        $createId = $this->task->find($createId);
        $createId->roleTask()->save(new RoleTask([
            "task_id" => $createId->id,
            "role_id"=> Request()->role_id
        ]));
        Alert::success('Sukses','Data berhasil Diperbaharui');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $joblist = Task::all();
        $role_list = RoleUser::all();
        return view('pages.admin.manajemen.mjob',compact('joblist','role_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_task = $this->task->find($id);
        $newRole = RoleUser::find(Request()->role_id);
        if($data_task->roleTask){
            $oldRole = $data_task->roleTask->role_id;
        } else{
            $oldRole = '';
        }
        if (Request()->code == $data_task->code &&
        Request()->task == $data_task->task_name &&
        Request()->points == $data_task->points &&
        Request()->role_id == $oldRole
        ) {
            Alert::warning('sama','Data Tidak Berubah');
            return redirect()->back();
        } else {
            Request()->validate([
                'code' => 'required|unique:tasks,code,'.Request()->id,
                'task_name' => 'required',
                'points' => 'required|integer',
                'role_id' => 'required',
            ], [
                'code.required' => 'Wajib Isi!!',
                'task_name.required' => 'Wajib Isi!!',
                'points.required' => 'Wajib Isi!!',
                'role_id.required' => 'Wajib Isi!!',
            ]);
            $update_data = [
                'code' => Request()->code,
                'task_name' => Request()->task_name,
                'points' => Request()->points,
            ];
            $this->task->editData($id,$update_data);
            if ($data_task->roleTask) {
                $data_task->roleTask->role_id = Request()->role_id;
                $data_task->roleTask->task_id = $id;
                $data_task->roleTask->push();
            }else{
                $data_task->roleTask()->save(new RoleTask([
                    "task_id"=>$id,
                    "role_id"=>$newRole->id
                ]));
            }
            Alert::success('Sukses','Data berhasil Diperbaharui');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->task->deleteData($id);
        DB::statement("ALTER TABLE tasks AUTO_INCREMENT = 1;");
        Alert::success('Sukses','Data berhasil Dihapus!!');
        return redirect()->back();
    }
}
