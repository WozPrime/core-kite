<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'code' => 'WB-JOB-001',
            'task_name' => 'Mengerjakan Proyek',
            'points' => 10,
        ]);
    }
}
