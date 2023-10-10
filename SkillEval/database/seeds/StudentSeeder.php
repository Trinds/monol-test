<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $classrooms = App\Classroom::all();

         foreach ($classrooms as $classroom) {
              factory(App\Student::class, 20)->create([
                'classroom_id' => $classroom->id,
              ]);
         }
    }
}
