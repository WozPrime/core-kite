<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function project(){
        return $this->belongsTo(ProjectModel::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
