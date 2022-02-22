<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'ficategory';
    protected $fillable = ['nama_kategori', 'jenis_kategori'];
    public $timestamps = false;
}
