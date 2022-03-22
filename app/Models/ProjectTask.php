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
        'details',
        'status',
        'checked_at',
        'expired_at',
        'post_date',
        'upload_details',
        'points',
        'feedback',
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
        return $this->belongsTo('App\Models\User','user_id');
    }


    public function project()
    {
        return $this->belongsTo(ProjectModel::class);
    }

    public function instance()
    {
        return $this->hasOneThrough(Instance::class,ProjectModel::class,'id','id','project_id','id');
    }

    public function tasks()
    {
        return $this->belongsTo('App\Models\Task','task_id');
    }

}
