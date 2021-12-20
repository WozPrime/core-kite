<?php

namespace Database\Seeders;

use App\Models\ProfUser;
use Illuminate\Database\Seeder;

class ProfUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfUser::create([
            'prof_code' => 'WP-001',
            'prof_name' => 'Web Programmer',
            'detail' => 'Coding Web',
        ]);
        ProfUser::create([
            'prof_code' => 'WP-002',
            'prof_name' => 'Web UI/UX',
            'detail' => 'Mendesain Web',
        ]);
    }
}
