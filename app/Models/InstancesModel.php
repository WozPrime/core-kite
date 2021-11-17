<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstancesModel extends Model
{
    use HasFactory;

    public function instance(){
        return $this->hasMany(Instance::class);
    }
}
