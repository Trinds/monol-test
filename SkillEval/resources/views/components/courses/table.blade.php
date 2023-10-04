<link rel="stylesheet" href="{{asset('css/courses.css')}}">
<div class="container">
<div class="div" id="content">
    <div class="title">
        <h1>Lista de Cursos</h1>
    </div>
    <div class="table-container">
        <table id="coursesTable">
            <tr>
                <th scope="col">Sigla</th>
                <th scope="col">Nome</th>
                <th scope="col"></th>
            </tr>
            @foreach ($courses as $course)
            <tr class="table-row">
                <td>{{ $course->abbreviation }}</td>
                <td>{{ $course->name }}</td>
            
                <td>
                    <a href="{{ route('courses.show', $course->id) }}"><i class="fa-solid fa-magnifying-glass detailsBtn"  data-toggle="modal" data-target="#showModal"></i></a>
                   <a href="{{route('courses.edit', $course->id)}}"><i class="fa-solid fa-pencil editBtn"></i></a>
                    <form action="{{route('courses.destroy', $course->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link p-0"><i class="fa-solid fa-trash deleteBtn"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
</div>