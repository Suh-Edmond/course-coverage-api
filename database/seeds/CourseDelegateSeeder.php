<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CourseDelegateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       // for ($i = 0; $i < 15; $i++) {
            DB::table('course_delegates')->insert([
                'access_id' =>"7532783487328348",
                'user_name' => "John Doe",
                'matricule_number' => "SC12A567",
                'email' => "johndoe@gmail.com",
                'telephone' => "674584834",
                'password' => Hash::make("password"),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        //}
    }


}
