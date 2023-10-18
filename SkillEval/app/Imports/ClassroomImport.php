<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Course;
use App\Classroom;
use App\Student;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
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

class ClassroomSheetImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $courseAbreviation = $row['abreviacao_do_curso'];
        $course = Course::where('abbreviation', $courseAbreviation)->first();

        return new Classroom([
            'course_id' => $course->id,
            'edition' => $row['edicao'],
            'start_date' => Date::excelToDateTimeObject($row['data_de_inicio_ddmmaaaa'])->format('Y-m-d'),
            'end_date' => Date::excelToDateTimeObject($row['data_de_termino_ddmmaaaa'])->format('Y-m-d'),
        ]);
        
    }

    public function rules(): array
    {
        return [
            'abreviacao_do_curso' => 'required|exists:courses,abbreviation',
            'edicao' => 'required|unique:classrooms,edition',
            'data_de_inicio_ddmmaaaa' => 'required',
            'data_de_termino_ddmmaaaa' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'abreviacao_do_curso.required' => 'A abreviação do curso deve ser preenchida no ficheiro Excel.',
            'abreviacao_do_curso.exists' => 'A abreviação do curso inserida no Excel não existe.',
            'edicao.required' => 'A edição deve ser preenchida no ficheiro Excel.',
            'edicao.unique' => 'A edição preenchida no Excel já existe.',
            'data_de_inicio_ddmmaaaa.required' => 'A data de início deve ser preenchida no ficheiro Excel.',
            'data_de_inicio_ddmmaaaa.before' => 'A data de início tem de ser anterior à data de término.',
            'data_de_termino_ddmmaaaa.required' => 'A data de término deve ser preenchida no ficheiro Excel.',
            'data_de_termino_ddmmaaaa.after' => 'A data de término tem de ser posterior à data de início.',
        ];
    }
}

class StudentsSheetImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $lastClassroom = Classroom::latest()->first();
        return new Student([
            'student_number' => $row['no_de_formando'],
            'name' => $row['nome'],
            'email' => $row['email'],
            'birth_date' => Date::excelToDateTimeObject($row['data_de_nascimento_ddmmaaaa'])->format('Y-m-d'),
            'classroom_id' => $lastClassroom->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'no_de_formando' => 'required|unique:students,student_number',
            'nome' => 'required',
            'email' => 'required|email|unique:students,email',
            'data_de_nascimento_ddmmaaaa' => 'required|before:today',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'no_de_formando.required' => 'O número de formando deve ser preenchido no ficheiro Excel.',
            'no_de_formando.unique' => 'Um número de formando preenchido no Excel já existe.',
            'nome.required' => 'Todos os campos Nome dos formandos devem ser preenchidos no ficheiro Excel.',
            'email.required' => 'Todos os campos de email do formando devem ser preenchidos no ficheiro Excel.',
            'email.email' => 'O email preenchido no Excel não é válido.',
            'email.unique' => 'Um email preenchido no Excel já está associado a outro formando.',
            'data_de_nascimento_ddmmaaaa.required' => 'Todas as datas de nascimento devem ser preenchidas no ficheiro Excel.',
            'data_de_nascimento_ddmmaaaa.before' => 'Todas as datas de nascimento têm de ser anteriores à data atual.',
        ];
    }
}
