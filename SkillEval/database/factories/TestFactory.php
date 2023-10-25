<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
        'type_id' => rand(1, 2),
        'date' => $faker->dateTimeBetween('now', '+30 days'),
        'moment' => $faker->randomElement(['Inicial', 'Intermédio', 'Final']),
    ];
});
