<div class="container">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($failures))
        <div class="alert alert-danger">
            <ul>
                <h4>Ocorreu um erro ao importar o Excel. Verifique os erros existentes:</h4>
                @foreach ($failures as $failure)
                    <li>- Erro: {{ implode(", ", $failure->errors()) }} (Linha: {{ $failure->row() }})</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="title">{{$classroom->course->abbreviation}} {{$classroom->edition}}</h1>
    <h5 class="subtitle">{{$classroom->course->name}}</h5>
    <h6 class="text-center"><strong>Início:</strong> {{ date('d-m-Y', strtotime($classroom->start_date))}}
        <strong>Fim:</strong> {{ date('d-m-Y', strtotime($classroom->end_date))}}</h6>
    <div class="d-flex justify-content-start excel-container">
        <form action="{{ route('students.import', $classroom) }}" method="POST" enctype="multipart/form-data"
              class="excel-form">
            @csrf
            <label for="file">Adicionar Formandos à Turma</label>
            <div class="form-group">
                <a href="{{ asset('templates/AdicionarAlunos.xlsx') }}" download>Download do Template Excel</a>
            </div>
            <div class="form-group-excel-form">
                <input type="file" name="file" id="file" accept=".xlsx,.xls" required>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

    @component('components.classrooms.classroom-chart', [
'classroom' => $classroom,
'classTechEval' => $classTechEval,
'classPsychoEval' => $classPsychoEval,
'techAvg' => $techAvg,
'psychAvg' => $psychAvg
])
    @endcomponent

    <div class="student-cards-container">
        @if ($classroom->students->count() == 0)
            <div class="alert alert-info" role="alert">
                Ainda não existem alunos para esta turma.
            </div>
        @endif
        @foreach ($classroom->students as $student)
            <div class="grid-card">
                <div class="grid-card-img">
                    <img src="{{ asset('storage/' . $student->image) }}" alt="Fotografia"/>
                </div>
                <div class="grid-card-details">
                    <p class="fw-bold mb-1">{{ isset($student) ?
                                                    implode(' ',[ explode(' ', $student->name)[0] , explode(' ', $student->name)[str_word_count($student->name)-1] ])
                                                    : $classroom->course->abbreviation . ' ' . $classroom->edition}}</p>
                    <p class="text-muted mb-0">{{ isset($student)? $student->student_number : 'Inicio: ' . $classroom->start_date}}</p>
                    <p class="text-muted mb-0">{{isset($student)? $student->email : 'Fim: ' . $classroom->end_date}} </p>
                    {{ !isset($student) && "<p class='text-muted mb-0'>Nº de alunos:" . $classroom->students->count() . "</p>" }}
                </div>
                <div class="grid-card-btns">
                    <a class="btn btn-link m-0 text-reset"
                       href="{{ route('students.show', $student->id) }}"
                       role="button"
                       data-ripple-color="primary">Detalhes<i class="bi bi-search"></i></a>
                </div>
            </div>
        @endforeach
    </div>
</div>
