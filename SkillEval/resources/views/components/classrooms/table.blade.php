    @if(session('success'))
    <div class="container alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="container alert alert-danger" role="alert">
        <h6><strong>Ups!</strong> Ocorreu um erro:</h6>
        <ul>
            @foreach($errors->all() as $error)
            <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="title">
        <h1>Lista de Turmas</h1>
    </div>
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