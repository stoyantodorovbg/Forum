<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Thread::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'channel_id' => function() {
            return factory('App\Models\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'slug' => str_slug($title),
        'image' => 'threads/default.jpg',
        'locked' => false,
    ];
});
