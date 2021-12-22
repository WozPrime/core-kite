<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectTask extends Model
{
    use HasFactory;
    protected $table = 'project_task';
    protected $fillable = [
        'user_id',
        'project_id',
        'task_id',
        'file_name',
        'expired_at',
    ];
    public function insertData($data)
    {
        DB::table('project_task')
        ->insert($data);
    }
    public function editData($id, $update_data)
    {
        DB::table('project_task')
        ->where('id', $id)
        ->update($update_data);
    }
    public function deleteData($id)
    {
        DB::table('project_task')
        ->where('id',$id)
        ->delete();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function project()
    {
        return $this->belongsToMany(ProjectModel::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

}
