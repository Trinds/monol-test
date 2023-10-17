<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Course;
use App\Classroom;
use App\Student;
use PhpOffice\PhpSpreadsheet\Shared\Date;


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
    private $newClassroomId;
    public function model(array $row)
    {
        if ($row[0] == 'Abreviação do Curso') {
            return null;
        }
        $courseAbreviation = $row[0];
        $edition = $row[1];
        $startDate = Date::excelToDateTimeObject($row[2])->format('Y-m-d');
        $endDate = Date::excelToDateTimeObject($row[3])->format('Y-m-d');

        $course = Course::where('abbreviation', $courseAbreviation)->first();

        return new Classroom([
            'course_id' => $course->id,
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
        if ($row[0] == 'Nº de Formando') {
            return null;
        }
        $studentNumber = $row[0];
        $studentName = $row[1];
        $studentEmail = $row[2];
        $studentBirthDate = Date::excelToDateTimeObject($row[3])->format('Y-m-d');

        $lastClassroom = Classroom::latest()->first();

        return new Student([
            'student_number' => $studentNumber,
            'name' => $studentName,
            'email' => $studentEmail,
            'birth_date' => $studentBirthDate,
            'classroom_id' => $lastClassroom->id,
        ]);
    }
}
