<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => "Giuseppe",
        'last_name' => "Desolda",
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'date_of_birth' => $faker->date('d-m-Y'),
        'country' => $faker->country,
        'gender' => "male",
        'affiliation' => 'Università degli studi di Bari',
        'lines_of_research' => 'ium,test,test',
        'remember_token' => str_random(10)
    ];


});
