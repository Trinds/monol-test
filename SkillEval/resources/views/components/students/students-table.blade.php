<div class="title">
    <h1>Lista de Alunos</h1>
</div>
<div class="table-container">
    <table id="studentsTable">
        <tr class="table-header">
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Turma</th>
            <th scope="col"></th>
        </tr>
        @foreach ($students as $student)
            <tr class="table-row">
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ date('d-m-Y', strtotime($student->birth_date)) }}</td>
                <td>{{ $student->classroom->course->abbreviation . $student->classroom->edition }}</td>
                <td>
                    <a href="{{ route('students.show', $student->id) }}"><i class="fa-solid fa-magnifying-glass detailsBtn"></i></a>
                    <a href="{{ route('students.edit', $student->id) }}"><i class="fa-solid fa-pencil editBtn"></i></a>
                    <a onclick="event.preventDefault();
                   document.getElementById('studentRmvForm').submit();">
                        <i class="fa-regular fa-trash-can removeBtn"></i>
                    </a>
                    <form id="studentRmvForm" action="{{route('students.destroy', $student->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
