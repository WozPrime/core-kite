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
            'task_name' => 'Membuat Rancangan Sistem',
            'points' => 20,
        ]);
        Task::create([
            'code' => 'WB-JOB-002',
            'task_name' => 'Mendesain UI/UX',
            'points' => 15,
        ]);
        
        Task::create([
            'code' => 'WB-JOB-003',
            'task_name' => 'Mengawasi Web Programmer',
            'points' => 10,
        ]);
        
        Task::create([
            'code' => 'WB-JOB-004',
            'task_name' => 'Membuat Back-End',
            'points' => 30,
        ]);
    }
}
