<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OutcomeModel extends Model
{
    use HasFactory;
    protected $table = 'income';
    protected $fillable =['nama_pengeluaran', 'kode_pengeluaran', 'tanggal_pengeluaran', 'kategori_pengeluaran', 'jenis_pengeluaran', 'nominal_pengeluaran', 'tujuan_pengeluaran', 'nota_pengeluaran', 'keterangan_pengeluaran'];
}
