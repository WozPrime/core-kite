<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IncomeModel extends Model
{
    use HasFactory;
    protected $table = 'income';
    protected $fillable =['nama_pemasukan', 'kode_pemasukan', 'tanggal_pemasukan', 'kategori_pemasukan', 'jenis_pemasukan', 'nominal_pemasukan', 'tujuan_pemasukan', 'nota_pemasukan', 'keterangan_pemasukan'];

    // public function insertData($data)
    // {
    //     DB::table('income')
    //     ->insert($data);
    // }
    // public function editData($id, $update_data)
    // {
    //     DB::table('income')
    //     ->where('id', $id)
    //     ->update($update_data);
    // }
    // public function deleteData($id)
    // {
    //     DB::table('income')
    //     ->where('id',$id)
    //     ->delete();
    // }

    public $timestamps = false;
}
