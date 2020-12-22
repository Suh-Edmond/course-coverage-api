<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $user_type;
    public function __construct()
    {
       
        $this->user_type = DB::table('user_types')->count();
    }
    public function run(Faker $faker)
    {
        for ($i =0; $i < 150; $i++){
            DB::table('users')->insert([
                'user_type_id'=> random_int(1, $this->user_type),
                'email'=>$faker->email,
                'first_name' =>$faker->firstName,
                'last_name'=>$faker->firstName,
                'registration_number'=>$faker->bankAccountNumber,
                'telephone'=>$faker->phoneNumber,
                'password'=> Hash::make("password"),
            ]);

        }
    }
}
