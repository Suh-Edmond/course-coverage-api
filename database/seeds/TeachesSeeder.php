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
        $this->lecturer = DB::table('users')
                        ->join('user_types', 'user_types.id', '=', 'users.user_type_id')
                        ->where('user_types.type', '=', 'Lecturer')
                        ->select('user_types.id')
                        ->count();
        $this->course = DB::table('courses')->count();
    }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < $this->lecturer; $i++) {
            DB::table('teaches')->insert([
                'user_id' => random_int(1, $this->lecturer),
                'course_id' => random_int(1, $this->course),
            ]);
        }
    }
}
