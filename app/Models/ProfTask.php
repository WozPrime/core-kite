<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfTask extends Model
{
    use HasFactory;
    protected $table = 'prof_task';
    protected $primaryKey = 'task_id';

    protected $fillable = [
        'task_id',
        'prof_id',
    ];
    

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }


    public function taskProf()
    {
        return $this->hasMany(ProfUser::class);
    }
}
