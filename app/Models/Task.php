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

    public function profTask()
    {
        return $this->hasOne(ProfTask::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function profs()
    {
        return $this->belongsToMany(ProfUser::class,'prof_task','task_id','prof_id');
    }
}
