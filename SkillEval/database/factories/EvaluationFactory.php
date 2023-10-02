<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Evaluation;
use Faker\Generator as Faker;

$factory->define(Evaluation::class, function (Faker $faker) {
    return [
        'student_id' => rand(1, 30),
        'test_id' => rand(1,6),
        'score' => $faker->numberBetween(0, 20),
    ];
});
