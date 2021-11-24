<?php

namespace Database\Seeders;

use App\Models\InstancesModel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class InstancesModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstancesModel::truncate();
        InstancesModel::create([
            'jenis_instansi' => 'Pemerintah'
        ]);
        InstancesModel::create([
            'jenis_instansi' => 'Swasta'
        ]);
        InstancesModel::create([
            'jenis_instansi' => 'Perorangan'
        ]);
    }
}
