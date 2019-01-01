<?php
use Faker\Factory as Faker;

$autoIncrement = autoIncrement();

$factory->define(\App\Models\ThreadTranslation::class, function () use ($autoIncrement) {
    $faker = Faker::create('es_ES');
    $autoIncrement->next();

    return [
        'thread_id' => $autoIncrement->current(),
        'language_id' => 3,
        'title' => $faker->realText(),
        'body' => $faker->realText(),
    ];
});

function autoIncrement()
{
    for ($i = 0; $i < 10; $i++) {
        yield $i;
    }
}