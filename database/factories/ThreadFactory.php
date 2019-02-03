<?php
use Faker\Generator as Faker;

$factory->define(\App\Models\Thread::class, function (Faker $faker) {
    $title = $faker->sentence();

    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'channel_id' => rand ( 0 , 9 ),
        'title' => $title,
        'body' => $faker->paragraph,
        'slug' => str_slug($title),
        'image' => 'threads/default.jpg',
        'locked' => false,
    ];
});
