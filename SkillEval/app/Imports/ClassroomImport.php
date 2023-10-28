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

class ClassroomImport implements WithMultipleSheets, ToModel, WithValidation, WithHeadingRow
{
    public function model(array $row)
    {
        $courseAbreviation = $row['abreviacao_do_curso'];
        $course = Course::where('abbreviation', $courseAbreviation)->first();
        if (!$course) {
            session()->flash('error', '- Erro: A edição do curso inserida não corresponde a nenhum curso ativo.');
            return null;
        }

        $edition = $row['edicao'];
        $existingClassroom = Classroom::where('edition', $edition)
            ->where('course_id', $course->id)
            ->first();
        if ($existingClassroom) {
            session()->flash('error', '- Erro: Já existe uma turma com a mesma edição e curso.');
            return null;
        }

        return new Classroom([
            'course_id' => $course->id,
            'edition' => $edition,
            'start_date' => Date::excelToDateTimeObject($row['data_de_inicio_ddmmaaaa'])->format('Y-m-d'),
            'end_date' => Date::excelToDateTimeObject($row['data_de_termino_ddmmaaaa'])->format('Y-m-d'),
        ]);
    }

    public function rules(): array
    {
        return [
            'abreviacao_do_curso' => 'required|exists:courses,abbreviation',
            'edicao' => ['required', 'max:255', 'regex:/^(0[1-9]|1[0-2])\.(0[1-9]|[1-9][0-9])$/'],
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
            'edicao.regex' => 'A edição preenchida no Excel não é válida.',
            'data_de_inicio_ddmmaaaa.required' => 'A data de início deve ser preenchida no ficheiro Excel.',
            'data_de_termino_ddmmaaaa.required' => 'A data de término deve ser preenchida no ficheiro Excel.',
        ];
    }

    public function sheets(): array
    {
        return [
            0 => new ClassroomImport(),
            1 => new StudentsImport(),
        ];
    }
}
