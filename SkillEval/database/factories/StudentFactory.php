<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'student_number' => $faker->unique()->numerify('T012####'),
        'classroom_id' => rand(1, 5),
        'email' => $faker->unique()->safeEmail,
        'birth_date' => $faker->date('Y-m-d', 'now'),
        'name' => $faker->name,
        'image' => 'images/default/student.png',
    ];
});
