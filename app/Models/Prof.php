<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prof extends Model
{
    use HasFactory;
    protected $table = 'profs';

    protected $fillable = [
        'prof_code',
        'prof_name',
        'detail',
        'prof_img',
    ];

    public function insertData($data)
    {
        DB::table('profs')
        ->insert($data);
    }
    public function editData($id, $update_data)
    {
        DB::table('profs')
        ->where('id', $id)
        ->update($update_data);
    }
    public function deleteData($id)
    {
        DB::table('profs')
        ->where('id',$id)
        ->delete();
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
