<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class AccessIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('course_dele_access_id')->insert([
                'course_code' => $faker->creditCardNumber,
                'access_id' => $faker->company,
            ]);
        }
    }
}
