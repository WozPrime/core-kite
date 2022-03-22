<?php

namespace Database\Seeders;
use App\Models\ProfTask;
use Illuminate\Database\Seeder;

class ProfTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfTask::create([
            'prof_id' => 1,
            'task_id' => 3,
        ]);
        ProfTask::create([
            'prof_id' => 2,
            'task_id' => 2,
        ]);
        ProfTask::create([
            'prof_id' => 3,
            'task_id' => 4,
        ]);
        ProfTask::create([
            'prof_id' => 4,
            'task_id' => 1,
        ]);
    }
}
