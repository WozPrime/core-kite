<?php

namespace Database\Seeders;

use App\Models\FiCategoryModel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class FiCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FiCategoryModel::create([
            'nama_kategori' => 'Non-Proyek [Pemasukan]',
            'jenis_kategori' => 'Pemasukan',
        ]);
        FiCategoryModel::create([
            'nama_kategori' => 'Non-Proyek [Pengeluaran]',
            'jenis_kategori' => 'Pengeluaran',
        ]);
    }
}