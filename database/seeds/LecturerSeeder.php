<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('lecturers')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'matricule_number' => $faker->bankAccountNumber,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'gender' => $faker->title,
                'password' => bcrypt($faker->password),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}
