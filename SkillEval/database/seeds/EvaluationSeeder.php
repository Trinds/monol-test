<?php

use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = App\Student::all();
        $testIds = range(1, 6);
    
        foreach ($students as $student) {
            shuffle($testIds); 
            $selectedTestIds = array_slice($testIds, 0, 6); 
    
            foreach ($selectedTestIds as $testId) {
                factory(App\Evaluation::class)->create([
                    'student_id' => $student->id,
                    'test_id' => $testId,
                ]);
            }
        }
    }
}
