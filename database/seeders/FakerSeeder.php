<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use DB;
use App\Models\User;
use App\Models\Client;
use App\Models\FiCategoryModel;
use App\Models\FinanceModel;
use App\Models\Instance;
use App\Models\ProfTask;
use App\Models\ProfUser;
use App\Models\ProjectModel;
use App\Models\ProjectAll;
use App\Models\Task;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('users')->insert([
    			'name' => $faker->name,
    			'email' => $faker->unique()->email,
    			'password' => bcrypt('12345678'),
    			'role' => $faker->randomElement(['admin', 'member']),
    		]);
        }
        for($i = 1; $i <= 8; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('instances')->insert([
    			'nama_instansi' => $faker->company,
    			'alamat_instansi' => $faker->address,
    			'kota_instansi' => $faker->city,
    			'instances_model_id' => $faker->randomElement([1, 2, 3]),
    		]);
        }
        for($i = 1; $i <= 8; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('ficategory')->insert([
    			'nama_kategori' => $faker->unique()->word,
    			'jenis_kategori' => $faker->randomElement(['Pemasukan', 'Pengeluaran']),
    		]);
        }
        for($i = 1; $i <= 5; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('profs')->insert([
    			'prof_code' => $faker->unique()->bothify('??-###'),
    			'prof_name' => $faker->jobTitle,
    			'detail' => $faker->word,
    		]);
        }
        for($i = 1; $i <= 6; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('profs')->insert([
    			'prof_code' => $faker->unique()->bothify('??-###'),
    			'prof_name' => $faker->jobTitle,
    			'detail' => $faker->word,
    		]);
        }
        for($i = 1; $i <= 10; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('tasks')->insert([
                'code' => $faker->unique()->bothify('??-JOB-###'),
                'task_name' => $faker->word,
                'points' => $faker->numberBetween(10,30),
    		]);
        }
        for($i = 1; $i <= 10; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('prof_task')->insert([
    			'prof_id' => $faker->numberBetween(1,15),
    			'task_id' => $faker->unique()->numberBetween(5,14),
    		]);
        }
        for($i = 1; $i <= 5; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('projects')->insert([
                'instance_id' => $faker->numberBetween(1,10),
                'client_id' => $faker->numberBetween(1,2),
                'project_code' => $faker->bothify('????'),
                'project_name' => $faker->jobTitle,
                'project_category' => $faker->jobTitle,
                'project_value' => $faker->bothify('Rp ##.###.###'),
                'project_detail' => $faker->text($maxNbChars = 50) ,
                'project_status' => $faker->randomElement(['Selesai', 'Tertunda', 'Baru']),
                'project_start_date' => $faker->dateTimeBetween($format = 'Y-m-d', $startDate = '-30 years', $endDate = '+10 years'),
                'project_deadline' => $faker->dateTimeBetween($format = 'Y-m-d', $startDate = 'now', $endDate = '+10 years'),
    		]);
        }
        for($i = 1; $i <= 5; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('projects')->insert([
                'instance_id' => $faker->numberBetween(1,10),
                'client_id' => $faker->numberBetween(1,2),
                'project_code' => $faker->bothify('????'),
                'project_name' => $faker->jobTitle,
                'project_category' => $faker->jobTitle,
                'project_value' => $faker->bothify('Rp ##.###.###'),
                'project_detail' => $faker->text($maxNbChars = 50) ,
                'project_status' => $faker->randomElement(['Selesai', 'Tertunda', 'Baru']),
                'project_start_date' => $faker->dateTimeBetween($format = 'Y-m-d', $startDate = '-30 years', $endDate = '+10 years'),
                'project_deadline' => $faker->dateTimeBetween($format = 'Y-m-d', $startDate = 'now', $endDate = '+10 years'),
    		]);
        }
        for($i = 1; $i <= 100; $i++){
 
    	    // insert data ke table tertentu menggunakan Faker
            DB::table('project_all')->insert([
    			'user_id' => $faker->numberBetween(1,50),
    			'project_id' => $faker->numberBetween(1,7),
    			'prof_id' => $faker->numberBetween(1,10),
    		]);
        }
    }
}
