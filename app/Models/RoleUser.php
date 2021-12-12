<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = 'roles';

    protected $fillable = [
        'role_code',
        'role_name',
        'detail',
        'role_img',
    ];

    public function insertData($data)
    {
        DB::table('roles')
        ->insert($data);
    }
    public function editData($id, $update_data)
    {
        DB::table('roles')
        ->where('id', $id)
        ->update($update_data);
    }
    public function deleteData($id)
    {
        DB::table('roles')
        ->where('id',$id)
        ->delete();
    }
    
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function projectTask(){
        return $this->belongsToMany(ProjectTask::class);
    }

}
