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
        $this->lecturer = DB::table('users')
                            ->join('user_types', 'user_types.id', '=', 'users.user_type_id')
                            ->where('user_types.type', '=', 'Lecturers')
                            ->select('user_types.id')
                            ->count();
        $this->course = DB::table('courses')->count();
         
    }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 90; $i++) {
            DB::table('coverages')->insert([
                'year' => $faker->year,
                'week_number' => $faker->numberBetween(1, 15),
                'day' => $faker->dayOfWeek(),
                'period' => $faker->time(),
                'topic_id' => random_int(1, $this->topic),
                'activity_id' => random_int(1, $this->activity),
                'user_id' => random_int(1, 37),
                'course_id' => random_int(1, $this->course),
            ]);
        }
    }
}
