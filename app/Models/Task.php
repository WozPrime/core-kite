<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'task_name',
        'code',
        'points',
    ];

    public function editData($id, $update_data)
    {
        DB::table('tasks')
        ->where('id', $id)
        ->update($update_data);
    }
    public function deleteData($id)
    {
        DB::table('tasks')
        ->where('id',$id)
        ->delete();
    }

    public function roleTask()
    {
        return $this->hasOne(RoleTask::class);
    }
    public function projectTask()
    {
        return $this->belongsToMany(ProjectTask::class);
    }

    public function roles()
    {
        return $this->belongsToMany(RoleUser::class,'role_task','task_id','role_id');
    }
}
