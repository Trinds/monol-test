<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="heading mb-3">
        <h1>{{$classroom->course->abbreviation}} {{$classroom->edition}}</h1>
        <h5>{{$classroom->course->name}}</h5>
        <h6>Início: {{$classroom->start_date}} <br>Fim: {{$classroom->end_date}}</h6>
    </div>
    <div class="chart-container">
        @component('components.classrooms.classroom-chart', ['classroom'=>$classroom])
        @endcomponent
    </div>
    <div class="row">
        @if ($classroom->students->count() == 0)
            <div class="alert alert-info" role="alert">
                Ainda não existem alunos para esta turma.
            </div>
        @endif
        @foreach ($classroom->students as $student)
            <div class="grid-card">
                <div class="grid-card-img">
{{--                    @if($user->image !== null)--}}
{{--                        <img src="{{ asset('storage/' . $user->image) }}" alt="Fotografia"/>--}}
{{--                    @else--}}

                        <img src="{{ asset('imgs/student.png') }}" alt="{{ $student->name }} Profile Image"/>
{{--                    @endif--}}
                </div>
                <div class="grid-card-details">
                    <p class="fw-bold mb-1">{{ isset($student) ?
                                                    implode(' ',[ explode(' ', $student->name)[0] , explode(' ', $student->name)[str_word_count($student->name)-1] ])
                                                    : $classroom->course->abbreviation .' ' . $classroom->edition}}</p>
                    <p class="text-muted mb-0">{{ isset($student)? 'Número: ' . $student->student_number : 'Inicio: ' . $classroom->start_date}}</p>
                    <p class="text-muted mb-0">{{isset($student)? 'Email: ' . $student->email : 'Fim: ' . $classroom->end_date}} </p>
                    {{ !isset($student) && "<p class='text-muted mb-0'>Nº de alunos:" . $classroom->students->count() . "</p>" }}
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
