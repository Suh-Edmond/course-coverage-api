<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        DB::table('user_types')->insert([
            'type' => 'Course Delegate',
        ]);
        DB::table('user_types')->insert([
            'type' => 'Lecturer',
        ]);
        DB::table('user_types')->insert([
            'type' => 'HOD',
        ]);
    }
}
