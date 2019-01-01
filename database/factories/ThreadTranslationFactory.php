<?php
use Faker\Factory as Faker;

$factory->define(\App\Models\ThreadTranslation::class, function () {
    $faker = Faker::create('es_ES');

    return [
        'thread_id' => 1,
        'language_id' => 3,
        'title' => $faker->realText(),
        'body' => $faker->realText(),
    ];
});