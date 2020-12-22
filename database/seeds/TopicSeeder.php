<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $outline;

    public function __construct()
    {
        $this->outline = DB::table('outlines')->count();
    }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('topics')->insert([
                'name' => $faker->sentence,
                'week_number' => $faker->numberBetween(1, 15),
                'outline_id' => random_int(1, $this->outline),
            ]);
        }
    }
}
