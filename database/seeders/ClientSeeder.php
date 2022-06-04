<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Client::truncate();
        Client::create([
            'instance_id' => '1',
            'user_id' => '4',
            'name' => 'Dahlia Mutiyah',
            'password' => bcrypt('12345678'),
            'email' => 'dahliamutiyah31@gmail.com',
            'phone_number' => '089526860333',
        ]);
        Client::create([
            'instance_id' => '2',
            'user_id' => '5',
            'name' => 'Yasmin Nur Iqram',
            'password' => bcrypt('12345678'),
            'email' => 'yasminiqram@gmail.com',
            'phone_number' => '082124073911',
        ]);
    }
}
