<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

//require_once __DIR__ . '/classes/random_compat/lib/random.php';
class AttendsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $course_delegate;
    private $course;

    public function __construct()
    {
        $this->course = DB::table('courses')->count();
        $this->course_delegate = DB::table('users')
                                ->join('user_types', 'user_types.id', '=', 'users.user_type_id')
                                ->where('user_types.type', '=', 'Course Delegate')
                                ->select('user_types.id')
                                ->count();
    }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < $this->course_delegate; $i++) {
            DB::table('attends')->insert([
                'user_id' => random_int(1, $this->course_delegate),
                'course_id' => random_int(1, $this->course),
            ]);
        }
    }
}
