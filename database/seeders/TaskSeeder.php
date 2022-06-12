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
            'deadlineBy' => 'D',
        ]);
        Task::create([
            'code' => 'WB-JOB-002',
            'task_name' => 'Mendesain UI/UX',
            'points' => 15,
            'deadlineBy' => 'D',
        ]);
        
        Task::create([
            'code' => 'WB-JOB-003',
            'task_name' => 'Mengawasi Web Programmer',
            'points' => 10,
            'deadlineBy' => 'H',
        ]);
        
        Task::create([
            'code' => 'WB-JOB-004',
            'task_name' => 'Membuat Back-End',
            'points' => 30,
            'deadlineBy' => 'D',
        ]);
        Task::create([
            'code' => 'WB-JOB-005',
            'task_name' => 'Membuat API',
            'points' => 20,
            'deadlineBy' => 'D',
        ]);
        Task::create([
            'code' => 'WB-JOB-006',
            'task_name' => 'Perbaiki UI',
            'points' => 15,
            'deadlineBy' => 'D',
        ]);
        
        Task::create([
            'code' => 'WB-JOB-007',
            'task_name' => 'Maintenance',
            'points' => 20,
            'deadlineBy' => 'D',
        ]);
        
        Task::create([
            'code' => 'WB-JOB-008',
            'task_name' => 'Perbaiki Back-End',
            'points' => 30,
            'deadlineBy' => 'D',
        ]);
        Task::create([
            'code' => 'WB-JOB-009',
            'task_name' => 'Debugging',
            'points' => 20,
            'deadlineBy' => 'D',
        ]);
    }
}
