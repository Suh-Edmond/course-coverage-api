<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('courses')->insert([
                'course_code' => $faker->creditCardNumber,
                'title' => $faker->city,
                'credit_value' => $faker->numberBetween(2, 6),
                'type' => $faker->creditCardType,
                'semester' => $faker->countryCode,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}
