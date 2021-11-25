<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    use HasFactory;
    protected $table = 'profs';

    protected $fillable = [
        'code',
        'pname',
        'detail',
    ];
}
