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
                <td>{{ $course->name }}</td>
                <td>{{ $course->abbreviation }}</td>
            
                <td>
                    <a href="{{ route('courses.show', $course->id) }}"><i class="fa-solid fa-magnifying-glass detailsBtn"  data-toggle="modal" data-target="#showModal"></i></a>
                    <i class="fa-solid fa-pencil editBtn"></i>
                    <i class="fa-regular fa-trash-can removeBtn"></i>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
</div>