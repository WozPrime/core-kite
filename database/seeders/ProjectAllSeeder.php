<?php

namespace Database\Seeders;

use App\Models\ProjectAll;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProjectAllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectAll::create([
            'user_id' => '2',
            'project_id' => '4',
            'prof_id' => '4'
        ]);
        ProjectAll::create([
            'user_id' => '2',
            'project_id' => '4',
            'prof_id' => '2'
        ]);
        ProjectAll::create([
            'user_id' => '3',
            'project_id' => '4',
            'prof_id' => '1'
        ]);
        ProjectAll::create([
            'user_id' => '8',
            'project_id' => '3',
            'prof_id' => '2'
        ]);
        ProjectAll::create([
            'user_id' => '8',
            'project_id' => '3',
            'prof_id' => '2'
        ]);
    }
}
