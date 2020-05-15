<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics_collection = factory(\App\Topic::class)->times(100)->make();

        $topics_array = $topics_collection->toArray();

        \App\Topic::insert($topics_array);
    }
}
