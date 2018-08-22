<?php

use Faker\Generator as Faker;

$factory->define(\App\Publication::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'venue' => $faker->sentence(2 , true),
        'publisher' => $faker->word,
        'volume' => $faker->randomNumber(2),
        'number' => $faker->randomDigitNotNull,
        'pages' => $faker->randomNumber(2) . ":" . $faker->randomNumber(2),
        'year' => $faker->year(),
        'type' => $faker->sentence(3),
        'description' => $faker->text
    ];
});

