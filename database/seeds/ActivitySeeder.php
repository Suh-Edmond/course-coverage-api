<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        DB::table('activities')->insert([
            'type' => 'Lecture',
        ]);
        DB::table('activities')->insert([
            'type' => 'Tutorial',
        ]);
        DB::table('activities')->insert([
            'type' => 'Practical',
        ]);
    }
}
