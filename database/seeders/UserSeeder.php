<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($a = 0; $a < 10; $a++)
        {
            User::create([
                'nama' => $faker->name(),
                'email' => $faker->email(),
                'telepon' => rand(8000000000000,9000000000000)
            ]);
        }
    }
}
