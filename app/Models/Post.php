<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'task',
        'code',
        'point',
        'prof_id',
    ];

    public function insertData($data)
    {
        DB::table('posts')
        ->insert($data);
    }
    public function editData($id, $update_data)
    {
        DB::table('posts')
        ->where('id', $id)
        ->update($update_data);
    }
    public function deleteData($id)
    {
        DB::table('posts')
        ->where('id',$id)
        ->delete();
    }

    public function prof()
    {
        return $this->belongsTo(Prof::class);
    }

}
