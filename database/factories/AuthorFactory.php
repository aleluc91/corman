<?php

use Faker\Generator as Faker;

$factory->define(\App\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale . " " . $faker->lastName,
        'dblp_url' => $faker->randomNumber(6 , false)
    ];
});
