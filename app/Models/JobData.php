<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JobData extends Model
{
    use HasFactory;
    protected $table = 'job_data';
    protected $fillable = [
        'posts_id',
        'users_id',
        'project.project_id',
        'expired_at',
    ];
    public function insertData($data)
    {
        DB::table('job_data')
        ->insert($data);
    }
    public function editData($id, $update_data)
    {
        DB::table('job_data')
        ->where('id', $id)
        ->update($update_data);
    }
    public function deleteData($id)
    {
        DB::table('job_data')
        ->where('id',$id)
        ->delete();
    }

}
