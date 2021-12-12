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
            'name' => 'Hina',
            'password' => bcrypt('12345678'),
            'email' => 'hina@student.bluearchive.ac.id',
            'phone_number' => '098569420',
        ]);
        Client::create([
            'instance_id' => '2',
            'name' => 'Amiya',
            'password' => bcrypt('12345678'),
            'email' => 'Amiya@rhodes.tr',
            'phone_number' => '089669420',
        ]);
    }
}
