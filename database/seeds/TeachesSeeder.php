<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class TeachesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $lecturer;
    private $course;

    public function __construct()
    {
        $this->lecturer = DB::table('lecturers')->count();
        $this->course = DB::table('courses')->count();
    }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 60; $i++) {
            DB::table('teaches')->insert([
                'lecturer_id' => random_int(1, $this->lecturer),
                'course_id' => random_int(1, $this->course),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}
