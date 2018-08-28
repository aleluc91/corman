<?php

use Faker\Generator as Faker;

$factory->define(\App\Publication::class, function (Faker $faker) {
    $type = ['Journal Articles' , 'Conference and Workshop Papers'];
    $randKeys = array_rand($type , 1);
    return [
        'title' => $faker->sentence(),
        'venue' => $faker->sentence(2 , true),
        'publisher' => $faker->word,
        'volume' => $faker->randomNumber(2),
        'number' => $faker->randomDigitNotNull,
        'pages' => $faker->randomNumber(2) . ":" . $faker->randomNumber(2),
        'year' => $faker->year(),
        'type' => $type[$randKeys],
        'description' => $faker->text
    ];
});

