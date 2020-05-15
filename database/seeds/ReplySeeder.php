<?php

use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $replies_collection = factory(\App\Reply::class)->times(1000)->make();

        $replies_array = $replies_collection->toArray();

        \App\Reply::insert($replies_array);
    }
}
