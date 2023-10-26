<?php

namespace App\Imports;
use App\Student;
use App\Classroom;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class StudentsImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $classroom;
    public function __construct($classroom)
    {
        $this->classroom = $classroom;
    }
    public function model(array $row)
    {

        return new Student([
            'student_number' => $row['no_de_formando'],
            'name' => $row['nome'],
            'email' => $row['email'],
            'birth_date' => Date::excelToDateTimeObject($row['data_de_nascimento_ddmmaaaa'])->format('Y-m-d'),
            'classroom_id' => $this->classroom->id + 1,
            'image' => 'images/default/student.png',
        ]);
    }

    public function rules(): array
    {
        return [
            'no_de_formando' => 'required|unique:students,student_number',
            'nome' => 'required|string|max:255',
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
            'nome.string' => 'O nome preenchido no Excel não é válido.',
            'email.required' => 'Todos os campos de email do formando devem ser preenchidos no ficheiro Excel.',
            'email.email' => 'O email preenchido no Excel não é válido.',
            'email.unique' => 'Um email preenchido no Excel já está associado a outro formando.',
            'data_de_nascimento_ddmmaaaa.required' => 'Todas as datas de nascimento devem ser preenchidas no ficheiro Excel.',
            'data_de_nascimento_ddmmaaaa.before' => 'Todas as datas de nascimento têm de ser anteriores à data atual.',
        ];
    }
}
