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
            'project_category' => 'Aplikasi',
            'project_value' => 'Rp 30.000.000',
            'project_detail' => 'Aplikasi enkripsi khusus',
            'project_status' => 'Selesai',
            'project_start_date' => '2021-12-04',
            'project_deadline' => '2022-03-09',
        ]);
        ProjectModel::create([
            'instance_id' => '2',
            'client_id' => '2',
            'project_code' => 'JHW',
            'project_name' => 'Website Helpdesk Jehuty',
            'project_category' => 'Website',
            'project_value' => 'Rp 21.000.000',
            'project_detail' => 'Landing Page & Customer Service untuk pengujung website Jehuty Tech',
            'project_status' => 'Dalam Pengerjaan',
            'project_start_date' => '2022-01-04',
            'project_deadline' => '2022-12-01',
        ]);
        ProjectModel::create([
            'instance_id' => '3',
            'client_id' => '3',
            'project_code' => 'CC',
            'project_name' => 'Cold Case',
            'project_category' => 'Aplikasi',
            'project_value' => 'Rp 21.000.000',
            'project_detail' => 'Aplikasi finansial',
            'project_status' => 'Dalam Pengerjaan',
            'project_start_date' => '2022-03-04',
            'project_deadline' => '2022-08-01',
        ]);
    }
}
