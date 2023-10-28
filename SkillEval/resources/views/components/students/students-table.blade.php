@if (session('success'))
    <div class="alert alert-success">
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
    <h1>Lista de Formandos</h1>
</div>
<div class="table-container">
    @if(count($students) < 1)
        <div class="alert alert-info m-5">
            Não foram encontrados resultados.
        </div>
    @else
        <table class="large-table" id="studentsTable">
            <tr class="table-header">
                <th></th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">Turma</th>
                <th scope="col">Ações</th>
            </tr>
            @foreach ($students as $student)
                <tr class="table-row">
                    <td>
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $student->image) }}" alt="Fotografia"/>
                        </div>
                    </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ date('d-m-Y', strtotime($student->birth_date)) }}</td>
                    <td>{{ $student->classroom->course->abbreviation . $student->classroom->edition }}</td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}"><i
                                class="fa-solid fa-magnifying-glass detailsBtn"></i></a>
                        <a href="{{ route('students.edit', $student->id) }}"><i class="fa-solid fa-pencil editBtn"></i></a>
                        <a class="deleteBtn" data-id="{{ $student->id }}" data-name="{{ $student->name }}"
                           data-entity="students">
                            <i class="fa-regular fa-trash-can removeBtn"></i>
                        </a>
                        <div id="confirmationBox">
                            <h2><strong>Apagar Formando</strong></h2>
                            <p class="confirmation-text" id="Name"></p>
                            <button id="confirmYesButton">Sim</button>
                            <button id="confirmNoButton">Não</button>
                        </div>
                        <form id="studentRmvForm{{$student->id}}" action="{{route('students.destroy', $student->id)}}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</div>

<div class="pagination-container">
    {{ $students->onEachSide(3)->links() }}
</div>
