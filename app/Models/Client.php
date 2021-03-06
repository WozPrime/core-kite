<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function project_model(){
        return $this->hasMany(ProjectModel::class);
    }
    
    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function client(){
        return $this->hasMany(Client::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
