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
        'tasks_id',
        'user_id',
        'project_id',
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

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function project()
    {
        return $this->belongsTo(ProjectModel::class);
    }

    public function roleUser()
    {
        return $this->hasOne(RoleUser::class);
    }

    

}
