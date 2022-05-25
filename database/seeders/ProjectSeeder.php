<?php

namespace Database\Seeders;

use App\Models\ProjectModel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ProjectModel::truncate();
        ProjectModel::create([
            'instance_id' => '1',
            'client_id' => '1',
            'project_code' => 'APT',
            'project_name' => 'Advance Packaging Tool',
            'project_category' => 'Peralatan',
            'project_value' => 'Rp 69.420.000.000',
            'project_detail' => 'Nama menjelaskan semuanya',
            'project_status' => 'Tertunda',
            'project_start_date' => '2020-01-01',
            'project_deadline' => '9999-12-01',
        ]);
        ProjectModel::create([
            'instance_id' => '2',
            'client_id' => '2',
            'project_code' => 'OC',
            'project_name' => 'Originium Cure',
            'project_category' => 'Medis',
            'project_value' => 'Rp 69.420.000.000',
            'project_detail' => 'Nama menjelaskan semuanya',
            'project_status' => 'Tertunda',
            'project_start_date' => '2020-01-01',
            'project_deadline' => '9999-12-01',
        ]);
    }
}
