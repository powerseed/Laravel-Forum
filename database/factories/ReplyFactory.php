<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Reply::class, function (Faker $faker)
{
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    $array_user_id = \App\User::all()->pluck('id')->toArray();
    $array_topic_id = \App\Topic::all()->pluck('id')->toArray();

    return [
        'topic_id' => $faker->randomElement($array_topic_id),
        'user_id' => $faker->randomElement($array_user_id),
        'content' => $faker->text(),
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
