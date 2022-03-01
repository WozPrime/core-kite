<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;
    protected $table="projects";
    protected $guarded = [
        'id',
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function projectAll(){
        return $this->hasMany(ProjectAll::class);
    }
    public function projectTask(){
        return $this->hasMany(ProjectTask::class);
    }
}
