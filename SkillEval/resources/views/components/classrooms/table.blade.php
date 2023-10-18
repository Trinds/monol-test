<div class="title">
    <h1>Lista de Turmas</h1>
</div>
<div class="table-container">
    <table class="coursesTable">
        <thead>
        <tr class="table-header">
            <th scope="col">Curso</th>
            <th scope="col">Edição</th>
            <th scope="col">Data de Começo</th>
            <th scope="col">Data de Conclusão</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classrooms as $classroom )
            <tr class="table-row">
                <td>{{ $classroom->course->abbreviation}}</td>
                <td>{{ $classroom->edition }}</td>
                <td>{{ date('d-m-Y', strtotime($classroom->start_date))}}</td>
                <td>{{ date('d-m-Y', strtotime($classroom->end_date))}}</td>
                <td>
                    <a href="{{ route('classrooms.show', $classroom->id) }}"><i class="fa-solid fa-magnifying-glass detailsBtn"></i></a>
                    <a href="{{ route('classrooms.edit', $classroom->id) }}"><i class="fa-solid fa-pencil editBtn"></i></a>
                    <a onclick="event.preventDefault();
                   document.getElementById('clasroomRmvForm').submit();">
                    <i class="fa-regular fa-trash-can removeBtn"></i>
                    </a>
                    <form id="clasroomRmvForm" action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
