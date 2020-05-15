<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedCategoryData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name' => 'Share',
                'description' => 'Share your ideas and discoveries'
            ],
            [
                'name' => 'Tutorials',
                'description' => 'Learn techniques'
            ],
            [
                'name' => 'Q&A',
                'description' => 'Help with others\' questions'
            ],
            [
                'name' => 'Announcements',
                'description' => 'News about the website'
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
