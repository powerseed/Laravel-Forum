<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Topic::class, function (Faker $faker) {
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    $array_user_id = \App\User::all()->pluck('id')->toArray();
    $array_category_id = \App\Category::all()->pluck('id')->toArray();

    return [
        'title' => $faker->sentence(),
        'body' => $faker->text(),
        'user_id' => $faker->randomElement($array_user_id),
        'category_id' => $faker->randomElement($array_category_id),
        'excerpt' => $faker->sentence(),
        'slug' => $faker->sentence(),
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
