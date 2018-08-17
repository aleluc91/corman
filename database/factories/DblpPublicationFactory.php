<?php

use Faker\Generator as Faker;

$factory->define(\App\Dblp\DblpPublication::class, function (Faker $faker) {
    $dblpPublication = \App\Dblp\DblpAPI::getAllPublications('Giuseppe' , 'Desolda');
    return $dblpPublication[array_rand($dblpPublication , 1)]->toArray();
});
