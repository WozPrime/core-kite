<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleTask extends Model
{
    use HasFactory;
    protected $table = 'role_task';
    protected $primaryKey = 'task_id';

    protected $fillable = [
        'task_id',
        'role_id',
    ];
    

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }


    public function taskRole()
    {
        return $this->hasMany(RoleUser::class);
    }
}
