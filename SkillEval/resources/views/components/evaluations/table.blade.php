<!-- First select element -->
<fieldset>
    <legend><span class="number">1</span> Informação do Curso</legend>
    <label for="course_id">Curso:</label>
    <select name="course_id" id="course_id" class="form-control">
        <option value="">Selecione...</option>
        @foreach ($courses as $course)
            <option value="{{$course->id}}">{{$course->abbreviation}}</option>
        @endforeach
    </select>
</fieldset>

<!-- Second select element -->
<fieldset>
    <legend><span class="number">2</span> Informação da Turma</legend>
    <label for="classroom_id">Turma:</label>
    <select name="classroom_id" id="classroom_id" class="form-control">
        <option value="">Selecione...</option>
        @foreach ($classrooms as $classroom)
            <option value="{{$classroom->id}}" data-course="{{$classroom->course_id}}">{{$classroom->edition}} </option>
        @endforeach
    </select>
</fieldset>

<div class="table-container">
        @if(!$hasResults)
        <div class="alert alert-info m-5">
            Não foram encontrados resultados.
        </div>
        @else
        <table class="coursesTable">
            <thead>
                <tr class="table-header">
                    <th scope="col">Curso</th>
                    <th scope="col">Edição</th>
                    <th scope="col">Data de Início</th>
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
        @endif
        {{ $classrooms->onEachSide(3)->links() }}
    </div>