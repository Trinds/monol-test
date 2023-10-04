
<div class="container">
    <div class="title">
        <h1>Lista de Turmas</h1>
    </div>
<div class="table-container">
    <table class="coursesTable">
        <tr>
            <th scope="col">Curso</th>
            <th scope="col">Edição</th>
            <th scope="col">Data de Começo</th>
            <th scope="col">Data de Conclusão</th>
            <th scope="col"></th>
        </tr>
        @foreach ($classrooms as $classroom )
            <tr class="table-row">
            <td>{{ $classroom->course->abbreviation}}</td>
            <td>{{ $classroom->edition }}</td>
            <td>{{ $classroom->start_date }}</td>
            <td>{{ $classroom->end_date }}</td>
            <td>
                <a href="{{ route('classrooms.show', $classroom->id) }}"><i class="fa-solid fa-magnifying-glass detailsBtn"></i></a>
                <a href="{{route('classrooms.edit', $classroom->id)}}"><i class="fa-solid fa-pencil editBtn"></i> </a>
                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="deleteBtn"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            </td> 
            @endforeach
        </tr>
        </tbody>
        </table>
    </div>
</div>