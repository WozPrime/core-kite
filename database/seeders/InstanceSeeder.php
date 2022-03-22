<?php

namespace Database\Seeders;

use App\Models\Instance;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class InstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Instance::truncate();
        Instance::create([
            'nama_instansi' => 'Berkas Biru',
            'alamat_instansi' => 'Nexon',
            'kota_instansi' => 'Seoul',
            'instances_model_id' => '1',
        ]);
        Instance::create([
            'nama_instansi' => 'Pulau Rhodes',
            'alamat_instansi' => 'Rim Billiton',
            'kota_instansi' => 'Terra',
            'instances_model_id' => '2',
        ]);
    }
}
