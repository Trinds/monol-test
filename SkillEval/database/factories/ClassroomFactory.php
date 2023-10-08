<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classroom;
use Faker\Generator as Faker;

$factory->define(Classroom::class, function (Faker $faker) {
    return [
        'course_id' => rand(1, 5),
        'edition' => str_pad($faker->numberBetween(1,12),2,"0",STR_PAD_LEFT) . '.' . $faker->numberBetween(20,23),
        'start_date' => $faker->dateTimeBetween('now', '+3 months', null),
        'end_date' => $faker->dateTimeBetween('+6 months', '+9 months', null),
    ];
});
