<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;
    protected $table="projects";
    protected $guarded = [
        'project_id',
    ];
}
