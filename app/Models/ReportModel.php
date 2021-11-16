<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    use HasFactory;
    public function allData()
    {
        return DB::table('reports')
        ->leftJoin('projects', 'project.project_id', '=', 'report.project_id')
        ->get();
    }
    protected $table="reports";
    protected $guarded = [
        'report_id',
    ];
}
