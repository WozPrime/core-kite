<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfUserModel extends Model
{
    use HasFactory;
    protected $table = 'user_prof';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'prof_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }


    public function userProf()
    {
        return $this->hasMany(ProfUser::class);
    }

}
