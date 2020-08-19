<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class CoverageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     */
    private $activity;
    private $topic;
    private $lecturer;
    private $course;
     

    public function __construct()
    {
        $this->activity = DB::table('activities')->count();
        $this->topic = DB::table('topics')->count();
        $this->lecturer = DB::table('lecturers')->count();
        $this->course = DB::table('courses')->count();
         
    }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 200; $i++) {
            DB::table('coverages')->insert([
                'year' =>"2019/2020",
                'week_number' => $faker->numberBetween(1, 15),
                'day' => $faker->dayOfWeek(),
                'period' => $faker->time(),
                'topic_id' => random_int(1, $this->topic),
                'activity_id' => random_int(1, $this->activity),
                'lecturer_id' => random_int(1, $this->lecturer),
                'course_id' => random_int(1, $this->course),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}
