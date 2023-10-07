<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="container">
<div class="heading mb-3">
    <h1>{{$classroom->course->abbreviation}} {{$classroom->edition}}</h1>
    <h5>{{$classroom->course->name}}</h5>
    <h6>Começo: {{$classroom->start_date}} <br>Fim: {{$classroom->end_date}}</h6>
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
    <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src='{{asset('imgs/student.png')}}' alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                    <div class="ms-3">
                        <p class="fw-bold mb-1">{{$student->name}}</p>
                        <p class="text-muted mb-0">Número: {{$student->student_number}}</p>
                        <p class="text-muted mb-0">E-mail: {{$student->email}}</p>
                     
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 bg-light p-2 d-flex justify-content-around">
                <a class="btn btn-link m-0 text-reset" href="#" role="button" data-ripple-color="primary">Ver<i class="bi bi-search"></i></a>
                <a class="btn btn-link m-0 text-reset" href="#" role="button" data-ripple-color="primary">Editar<i class="bi bi-pencil-fill"></i></a>
        </div>
    </div>
</div>
    @endforeach
</div>
</div>