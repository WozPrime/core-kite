<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectAll extends Model
{
    use HasFactory;
    protected $table = 'project_all';
    protected $fillable = [
        'user_id',
        'project_id',
        'file_name',
        'expired_at',
    ];
    public function insertData($data)
    {
        DB::table('project_all')
        ->insert($data);
    }
    public function editData($id, $update_data)
    {
        DB::table('project_all')
        ->where('id', $id)
        ->update($update_data);
    }
    public function deleteData($id)
    {
        DB::table('project_all')
        ->where('id',$id)
        ->delete();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function project()
    {
        return $this->belongsTo(ProjectModel::class);
    }

    public function profUser()
    {
        return $this->hasMany(ProfUser::class,'id','prof_id');
    }

    

}
