<?php

use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $courses = App\Course::all();

        foreach ($courses as $course) {
            factory(App\Classroom::class, 3)->create([
                'course_id' => $course->id,
            ]);
        }
    }
}
