<?php

namespace Database\Seeders;

use App\Models\ProjectTask;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProjectTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectTask::create([
            'task_id' => '2',
            'user_id' => '8',
            'project_id' => '3',
            'details' => 'Tugas Test Seeder',
            'status' => '2',
            'points' => '5',
            'start_at' => '2021-4-12 12:12:00',
            'expired_at' => '2022-8-12 12:12:00'
        ]);
        ProjectTask::create([
            'task_id' => '3',
            'user_id' => '8',
            'project_id' => '3',
            'details' => 'Tugas Test Seeder 2',
            'start_at' => '2022-5-12 12:12:00',
            'expired_at' => '2022-7-12 12:12:00'
        ]);
    }
}
