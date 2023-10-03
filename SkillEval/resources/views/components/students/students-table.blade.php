<div class="title">
        <h1>Lista de Alunos</h1>
</div>
<div class="table-container">
    <table id="coursesTable">
        <tr>
            <th scope="col">Sigla</th>
            <th scope="col">Nome</th>
            <th scope="col"></th>
        </tr>
        @foreach ($students as $student)
            <tr class="table-row">
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <a href="{{ route('courses.show', $student->id) }}"><i class="fa-solid fa-magnifying-glass detailsBtn"  data-toggle="modal" data-target="#showModal"></i></a>
                    <i class="fa-solid fa-pencil editBtn"></i>
                    <i class="fa-regular fa-trash-can removeBtn"></i>
                </td>
            </tr>
        @endforeach
    </table>
</div>
