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
use Illuminate\Support\Facades\Validator;



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

class ClassroomSheetImport implements ToModel, WithValidation, WithHeadingRow
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
            'edicao' => 'required|max:255',
            'data_de_inicio_ddmmaaaa' => 'required',
            'data_de_termino_ddmmaaaa' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'abreviacao_do_curso.required' => 'A abreviação do curso deve ser preenchida no ficheiro Excel.',
            'abreviacao_do_curso.exists' => 'A abreviação do curso preenchida no Excel não existe.',
            'edicao.required' => 'A edição deve ser preenchida no ficheiro Excel.',
            'edicao.max' => 'A edição preenchida no Excel não pode ter mais de 255 caracteres.',
            'data_de_inicio_ddmmaaaa.required' => 'A data de início deve ser preenchida no ficheiro Excel.',
            'data_de_termino_ddmmaaaa.required' => 'A data de término deve ser preenchida no ficheiro Excel.',
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
            'image' => 'images/default/student.png'
        ]);
    }

    public function rules(): array
    {
        return [
            'no_de_formando' => 'required|unique:students,student_number',
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:students,email',
            'data_de_nascimento_ddmmaaaa' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'no_de_formando.required' => 'O número de formando deve ser preenchido no ficheiro Excel.',
            'no_de_formando.unique' => 'O número de formando preenchido no Excel já existe.',
            'nome.required' => 'O nome deve ser preenchido no ficheiro Excel.',
            'nome.max' => 'O nome preenchido no Excel não pode ter mais de 10 caracteres.',
            'email.required' => 'O email deve ser preenchido no ficheiro Excel.',
            'email.email' => 'O email preenchido no Excel não é válido.',
            'email.unique' => 'O email preenchido no Excel já existe.',
            'data_de_nascimento_ddmmaaaa.required' => 'A data de nascimento deve ser preenchida no ficheiro Excel.',
        ];
    }
}
