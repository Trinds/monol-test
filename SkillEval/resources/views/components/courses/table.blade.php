<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin-bottom: 0px;">
            @foreach ($errors->all() as $error)
            <li style="list-style: none;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
</div>
<div class="title">
    <h1>Lista de Cursos</h1>
</div>
<div class="table-container">
    @if(!$hasResults)
    <div class="alert alert-info m-5">
        Não foram encontrados resultados.
    </div>
    @else
    <table id="coursesTable">
        <tr class="table-header">
            <th scope="col">Sigla</th>
            <th scope="col">Nome</th>
            <th scope="col"></th>
        </tr>
        @foreach ($courses as $course)<tr class="table-row">
            <td>{{ $course->abbreviation }}</td>
            <td>{{ $course->name }}</td>
            <td>
                <a href="{{ route('courses.show', $course->id) }}"><i class="fa-solid fa-magnifying-glass detailsBtn" data-toggle="modal" data-target="#showModal"></i></a>
                <a href="{{route('courses.edit', $course->id)}}"><i class="fa-solid fa-pencil editBtn"></i></a>
                <a onclick="event.preventDefault();
                   document.getElementById('courseRmvForm').submit();">
                    <i class="fa-regular fa-trash-can removeBtn"></i>
                </a>
                <form id="courseRmvForm" action="{{route('courses.destroy', $course->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @endif
    {{ $courses->onEachSide(3)->links() }}
</div>