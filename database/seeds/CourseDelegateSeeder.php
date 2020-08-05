<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class CourseDelegateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 15; $i++) {
            DB::table('course_delegates')->insert([
                'user_name' => $faker->firstName,
                'matricule_number' => $faker->bankAccountNumber,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'password' => bcrypt($faker->password),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }


}
