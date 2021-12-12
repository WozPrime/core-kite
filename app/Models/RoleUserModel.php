<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUserModel extends Model
{
    use HasFactory;
    protected $table = 'user_role';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }


    public function userRole()
    {
        return $this->hasMany(RoleUser::class);
    }

}
