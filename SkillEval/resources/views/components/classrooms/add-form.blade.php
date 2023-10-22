<div class="container">
    <div class="pt-2">
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
                <li>- Erro: {{ implode(", ", $failure->errors()) }} (Linha: {{ $failure->row() }}) </li>
                @endforeach
            </ul>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ocorreram alguns problemas com os campos preenchidos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
                @endforeach
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <div class="pb-3 pt-2">
        <h1>Opções:</h1>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="formType" id="manualRadio" value="manual" checked>
            <label class="form-check-label" for="manualRadio">
                Formulário da Turma
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="formType" id="importRadio" value="import">
            <label class="form-check-label" for="importRadio">
                Importar Excel com Turma e Formandos
            </label>
        </div>
    </div>

    <form action="{{ url('classrooms') }}" method="POST" id="manualForm">
        @csrf
        <h1>Adicionar Turma</h1>

        <fieldset>
            <legend><span class="number">1</span> Informação do Curso</legend>
            <label for="course_id">Curso:</label>
            <select name="course_id" id="course_id" class="form-control">
                @foreach ($courses as $course)
                <option value="{{$course->id}}">{{$course->abbreviation}}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset>
            <legend><span class="number">2</span> Informação da Turma</legend>

            <label for="edition">Edição:</label>
            <input type="text" id="edition" name="edition" class="form-control" placeholder="Edição da turma" @error('edition') is-invalid @enderror value="{{old('edition')}}" required aria-describedat="editionHelp">
            <small id="editionHelp" class="form-text text-muted">Ex: 2021/2022</small>

            <label for="start_date">Data de iníco:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" placeholder="Data de início da turma" @error('start_date') is-invalid @enderror required aria-describedat="start_dateHelp">
            <small id="start_dateHelp" class="form-text text-muted">Ex: 2021-09-01</small>

            <label for="end_date">Data de conclusão:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" placeholder="Data de conclusão da turma" @error('end_date') is-invalid @enderror required aria-describedat="end_dateHelp">
            <small id="end_dateHelp" class="form-text text-muted">Ex: 2022-06-30</small>
        </fieldset>
        <div class="form-group">
            <button type="submit">Adicionar</button>
        </div>
    </form>
    <form action="{{ route('classrooms.import') }}" method="POST" enctype="multipart/form-data" id="importForm" style="display: none;">
        @csrf
        <label for="file">Adicionar Turma e Formandos</label>
        <div class="form-group">
            <a href="{{ asset('templates/AddTurmaEAlunos.xlsx') }}" download>Download do Template Excel</a>
        </div>
        <div class="form-group">
            <input type="file" name="file" id="file" accept=".xlsx,.xls" required>
        </div>
        <button type="submit">Enviar</button>
    </form>
</div>