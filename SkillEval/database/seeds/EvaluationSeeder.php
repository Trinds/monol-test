<?php

use Illuminate\Support\Facades\DB;
use App\Test;
use App\Student;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    public function run()
    {
         $students = Student::all();

         $tests = Test::all();

         foreach ($students as $student)
         {
             foreach ($tests as $test)
             {
                 DB::table('evaluations')->insert([
                     'student_id' => $student->id,
                     'test_id' => $test->id,
                     'score' => rand(0, 20),
                     'date' => now(),
                     'created_at' => now(),
                     'updated_at' => now()
                 ]);
             }
         }

    }
}
