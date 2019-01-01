<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Reply::class, function (Faker $faker) {
    return [
        'thread_id' => function() {
            $thread = factory('App\Models\Thread')->create();
            factory('App\Models\ThreadTranslation', ['thread_id', $thread->id])->create();

            return $thread->id;
        },
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});
