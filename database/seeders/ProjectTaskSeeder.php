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
            'task_id' => '1',
            'user_id' => '2',
            'project_id' => '4',
            'details' => 'Tugas Test Seeder',
            'status' => '2',
            'points' => '15',
            'start_at' => '2022-05-12 12:12:00',
            'expired_at' => '2022-06-12 12:12:00'
        ]);
        ProjectTask::create([
            'task_id' => '2',
            'user_id' => '2',
            'project_id' => '4',
            'details' => 'Tugas Test Seeder',
            'status' => '1',
            'start_at' => '2022-05-12 12:12:00',
            'expired_at' => '2022-06-12 12:12:00'
        ]);
        ProjectTask::create([
            'task_id' => '5',
            'user_id' => '3',
            'project_id' => '4',
            'details' => 'Tugas Test Seeder',
            'status' => '2',
            'points' => '20',
            'start_at' => '2022-03-12 12:12:00',
            'expired_at' => '2022-04-12 12:12:00'
        ]);
        ProjectTask::create([
            'task_id' => '2',
            'user_id' => '8',
            'project_id' => '3',
            'details' => 'Tugas Test Seeder',
            'status' => '1',
            'start_at' => '2022-05-12 12:12:00',
            'expired_at' => '2022-07-12 12:12:00'
        ]);
        ProjectTask::create([
            'task_id' => '3',
            'user_id' => '8',
            'project_id' => '3',
            'details' => 'Tugas Test Seeder 2',
            'start_at' => '2022-06-12 12:12:00',
            'expired_at' => '2022-09-12 12:12:00'
        ]);
    }
}
