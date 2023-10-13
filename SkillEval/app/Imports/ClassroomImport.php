<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Course;
use App\Classroom;
use App\Student;
use Carbon\Carbon;

class ClassroomImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new ClassroomSheetImport(),
            1 => new StudentsSheetImport(),
        ];
    }
}

class ClassroomSheetImport implements ToModel
{
    public function model(array $row)
    {
        $courseAbreviation = $row['abreviacao_curso'];
        $edition = $row[1];
        $startDate = Carbon::createFromFormat('d/m/Y', $row[2])->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d/m/Y', $row[3])->format('Y-m-d');


        // Encontre o ID do curso com base no nome do curso
        $course = Course::where('abbreviation', $courseAbreviation)->first();

        // Crie a turma
        return new Classroom([
            'course_id' => 1,
            'edition' => $edition,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}

class StudentsSheetImport implements ToModel
{
    public function model(array $row)
    {
        $studentNumber = $row[0];
        $studentName = $row[1];
        $studentEmail = $row[2];
        $studentBirthDate = Carbon::createFromFormat('d/m/Y', $row[3])->format('Y-m-d');

        // Atribua a classroom_id com base na última turma criada
        $lastClassroom = Classroom::latest()->first();

        // Crie o aluno e associe-o à última turma criada
        return new Student([
            'student_number' => $studentNumber,
            'name' => $studentName,
            'email' => $studentEmail,
            'birth_date' => $studentBirthDate,
            'classroom_id' => $lastClassroom->id,
        ]);
    }
}

