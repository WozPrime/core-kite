<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUser::create([
            'role_code' => 'WP-001',
            'role_name' => 'Web Programmer',
            'detail' => 'Coding Web',
        ]);
        RoleUser::create([
            'role_code' => 'WP-002',
            'role_name' => 'Web UI/UX',
            'detail' => 'Mendesain Web',
        ]);
    }
}
