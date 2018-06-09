<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Channel::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->slug(),
    ];
});
