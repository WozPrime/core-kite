<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $table = 'document';

    protected $fillable = [
        'pt_id',
        'file_name'
    ];
    
}
