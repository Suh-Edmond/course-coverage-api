<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class OutlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $course;

    public function __construct()
    {
        $this->course = DB::table('courses')->count();
    }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('outlines')->insert([
                'year' => $faker->year,
                'course_id' => random_int(1, $this->course),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}
