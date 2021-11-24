<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstancesModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function instance(){
        return $this->hasMany(Instance::class);
    }
        public $timestamps = false;
    
}
