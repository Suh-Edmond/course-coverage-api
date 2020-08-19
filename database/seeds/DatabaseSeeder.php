<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         $this->call(ActivitySeeder::class);
        $this->call(CourseDelegateSeeder::class);
        $this->call(LecturerSeeder::class);
        $this->call(UserSeeder::class);
       /* $this->call(CourseSeeder::class);
        $this->call(CourseScheduleSeeder::class);
        $this->call(TeachesSeeder::class);
        $this->call(AttendsSeeder::class);
        $this->call(OutlineSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(HasActivitySeeder::class);*/
       // $this->call(CoverageSeeder::class);
    }
}
