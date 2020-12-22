<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class HasActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $topic;
    private $activity;

    public function __construct()
    {
        $this->topic = DB::table('topics')->count();
        $this->activity = DB::table('activities')->count();
    }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 60; $i++) {
            DB::table('has_activities')->insert([
                'topic_id' => random_int(1, $this->topic),
                'activity_id' => random_int(1, $this->activity),
            ]);
        }
    }
}
