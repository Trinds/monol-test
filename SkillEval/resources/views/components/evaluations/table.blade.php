<div class="container">
    <h1 class="h1 text-center">Inserção de Pauta</h1>
    <div class="row">
        <div class="col">
            <label for="course_id">Curso:</label>
            <select name="course_id" id="course_id" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->abbreviation }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <form method="get" action="/evaluations">
                <label for="classroom_id">Turma</label>
                <select class="form-control" id="classroom_id" name="classroom_id" onchange="this.form.submit()">
                    <option value="">Selecione...</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" data-course="{{ $classroom->course_id }}">
                            {{ $classroom->edition }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col">
            <label for="test_id">Teste:</label>
            <select name="test_id" id="test_id" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($tests as $test)
                    <option value="{{ $test->id }}">{{ $test->type->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="moment_id">Momento:</label>
            <select name="moment_id" id="moment_id" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($tests as $test)
                    <option value="{{ $test->id }}">{{ $test->moment }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <form method="POST" action="{{ url('evaluations') }}">
        @csrf
        <input type="hidden" name="grades" id="grades" value="">
        <div class="mx-auto" style="width: 250px" id="insert_button">
            <button class="m-5" type="submit">Inserir Pauta</button>
        </div>
    </form>

    @if ($students)
    <div class="table-container">
        <table class="coursesTable">
            <thead>
                <tr class="table-header">
                    <th scope="col">Nome</th>
                    <th scope="col">Turma</th>
                    <th scope="col">Nota</th>
                </tr>
            </thead>
            <p id="selectedClassroomEdition"></p>
            <tbody>
                @foreach ($students as $student)
                <tr class="table-row">
                    <td>{{ $student->name }}</td>
                    <td>
                        {{ $student->classroom->course->abbreviation }} {{ $student->classroom->edition }}
                    </td>
                    <td>
                        <input type="number" name="grades[{{ $student->id }}]" step="0.01" min="0" max="20">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
