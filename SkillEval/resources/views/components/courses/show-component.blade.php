<div class="container">
    <div class="heading mb-3">
        <h1>{{$course->abbreviation}}</h1>
        <h5>{{$course->name}}</h5>
    </div>
    <div class="row">

        @if($course->classrooms->count() == 0)
            <div class="alert alert-info" role="alert">
                Ainda não existem turmas para este curso.
            </div>
        @endif
        @foreach ($course->classrooms as $classroom)
            <div class="grid-card">
                <div class="grid-card-img">
                    <img src="/imgs/classroom.png"/>
                </div>
                <div class="grid-card-details">
                    <p class="fw-bold mb-1">{{ $classroom->course->abbreviation . ' ' . $classroom->edition }}</p>
                    <p class="text-muted mb-0">Inicio: {{ $classroom->start_date }}</p>
                    <p class="text-muted mb-0">Fim: {{ $classroom->end_date }} </p>
                    <p class="text-muted mb-0">Nº de alunos: {{ $classroom->students->count() }}</p>
                </div>
                <div class="grid-card-btns">
                    <a class="btn btn-link m-0 text-reset"
                       href="{{ route('classrooms.show', $classroom->id) }}"
                       role="button"
                       data-ripple-color="primary">Ver<i class="bi bi-search"></i></a>
                    <a class="btn btn-link m-0 text-reset"
                       href="{{route('classrooms.edit', $classroom->id)}}"
                       role="button"
                       data-ripple-color="primary">Editar<i class="bi bi-pencil-fill"></i></a>
                </div>
            </div>
        @endforeach
    </div>
</div>
