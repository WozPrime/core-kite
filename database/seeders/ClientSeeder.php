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
        Client::create([
            'instance_id' => '3',
            'user_id' => '9',
            'name' => 'Rita Arsenco',
            'password' => bcrypt('12345678'),
            'email' => 'arsenorita@gmail.com',
            'phone_number' => '083192753645',
        ]);
        Client::create([
            'instance_id' => '3',
            'user_id' => '10',
            'name' => 'Klien',
            'password' => bcrypt('12345678'),
            'email' => 'klienuji@gmail.com',
            'phone_number' => '083192753420',
        ]);
        Client::create([
            'instance_id' => '4',
            'user_id' => '8',
            'name' => 'Klien',
            'password' => bcrypt('12345678'),
            'email' => 'hello@idekite.id',
            'phone_number' => '082350729317',
        ]);
    }
}
