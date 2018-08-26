<?php

use Faker\Generator as Faker;

$factory->define(\App\Multimedia::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl($width = 640, $height = 480 , 'cats'),
        'type' => $faker->fileExtension
    ];
});
