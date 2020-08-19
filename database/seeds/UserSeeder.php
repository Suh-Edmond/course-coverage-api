<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
             'user_id' => 1,
             'identified' => 'johndoe@gmail.com',
             'user_type' =>'course_delegates',
             'password' => Hash::make('password')
         ]);
         DB::table('users')->insert([
            'user_id' => 1,
            'identified' => 'jamesdoe@gmail.com',
            'user_type' =>'lecturers',
            'password' => Hash::make('newpassword')
        ]);
    }
}
