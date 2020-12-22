<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class CourseScheduleSeeder extends Seeder
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
        for ($i = 0; $i < 40; $i++) {
            DB::table('course_schedules')->insert([
                'day' => $faker->dayOfWeek,
                'period' => $faker->time(),
                'venue' => $faker->country,
                'course_id' => random_int(1, $this->course),
            ]);
        }
    }
}
