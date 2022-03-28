<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(InstancesModelSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(InstanceSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(ProfUserSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(FiCategorySeeder::class);
        $this->call(ProfTaskSeeder::class);
        $this->call(FakerSeeder::class);
    }
}
