<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function instances_model(){
        return $this->belongsTo(InstancesModel::class);
    }

    public function client(){
        return $this->hasMany(Client::class);
    }

    public $timestamps = false;
}
