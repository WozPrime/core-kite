<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        User::create([
            'name' => 'Husni Ramadhan',
            'email' => 'husniramadhan@student.untan.ac.id',
            'password' => bcrypt('123123123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Ilham FF',
            'email' => 'dtest5444@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Raihan Mar ie Akhmadin',
            'email' => 'raihan.akhmadin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Dahlia Mutiyah',
            'email' => 'dahliamutiyah31@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);
        User::create([
            'name' => 'Yasmin Nur Iqram',
            'email' => 'yasminiqram@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);
    }
}

