<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['TPSI', 'GRSIP', 'MAPCP', 'ARCI', 'GCE']),
    ];
});
