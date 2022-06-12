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
            'nama_instansi' => 'JITTER',
            'alamat_instansi' => 'Jl. Cikutra No.404, Sukapada, Kec. Kidul, Kota Adiarsa',
            'kota_instansi' => 'Adiarsa',
            'instances_model_id' => '1',
        ]);
        Instance::create([
            'nama_instansi' => 'Jehuty Tech',
            'alamat_instansi' => 'Jl. Sentra Niaga 40A Ruko 237, Kota Harapan Pupus',
            'kota_instansi' => 'Bekasi',
            'instances_model_id' => '2',
        ]);
        Instance::create([
            'nama_instansi' => 'Horizon Finance',
            'alamat_instansi' => 'Jl. Jendral Sudirman Rt. 49',
            'kota_instansi' => 'Balikpapan',
            'instances_model_id' => '2',
        ]);
        Instance::create([
            'nama_instansi' => 'IdeKite',
            'alamat_instansi' => 'Jl. HM Suwignyo Gg. Margodadirejo1 No.12A Kelurahan Sungai Jawi Kecamatan Pontianak Barat, Sungai Jawi Dalam, Kec. Pontianak Kota, Kota Pontianak, Kalimantan Barat 78113',
            'kota_instansi' => 'Pontianak',
            'instances_model_id' => '2',
        ]);
    }
}
