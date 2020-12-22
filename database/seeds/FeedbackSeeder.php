<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $course;
    private $user;

    public function __construct()
    {
        $this->course = DB::table('courses')->count();
        $this->user = DB::table('users')
                                ->join('user_types', 'user_types.id', '=', 'users.user_type_id')
                                ->where('user_types.type', '=', 'Course Delegate')
                                ->select('user_types.id')
                                ->count();
    }
    public function run(Faker $faker)
    {
        for($i =0; $i < 20; $i++)
        {
            DB::table('feedback')->insert([
                'course_id'=>random_int(1, $this->course),
                'user_id'=>random_int(1,$this->user),
                'feedback' => $faker->sentence(),
                'year'=>$faker->year()
            ]);
        }
    }
}
