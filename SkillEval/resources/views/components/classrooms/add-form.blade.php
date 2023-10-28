<div class="container">
        <h1 class="title">Adicionar Turma</h1>
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
                        <li>- Erro: {{ implode(", ", $failure->errors()) }} (Linha: {{ $failure->row() }})</li>
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
                <h4>Ocorreu um erro ao importar o Excel.</h4>
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="option-container">
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="formType" id="manualRadio" value="manual" checked>
                Formulário da turma
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="formType" id="importRadio" value="import">
                Importar Excel com turma e formandos
            </label>
        </div>
    </div>

    <form action="{{ url('classrooms') }}" method="POST" id="manualForm" class="create-form">
        @csrf

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">1</span> Informação do curso <i
                    class="fa-solid fa-bookmark form-icon"></i>
            </legend>
            <label for="course_id" class="form-label">Curso:</label>
            <select name="course_id" id="course_id" class="form-control-select">
                @foreach ($courses as $course)
                    <option value="{{$course->id}}">{{$course->abbreviation}}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">2</span> Informação da turma <i
                    class="fa-solid fa-users form-icon"></i>
            </legend>

            <label for="edition" class="form-label">Edição:</label>
            <input type="text" id="edition" name="edition" class="form-input" placeholder="Edição da turma"
                   @error('edition') is-invalid @enderror value="{{old('edition')}}" required
                   aria-describedby="editionHelp">
            <small id="editionHelp" class="form-text text-muted">Exemplo: 07.22</small>

            <label for="start_date">Data de iníco:</label>
            <input type="date" id="start_date" name="start_date" class="form-input"
                   placeholder="Data de início da turma" @error('start_date') is-invalid @enderror required
                   aria-describedat="start_dateHelp">

            <label for="end_date">Data de conclusão:</label>
            <input type="date" id="end_date" name="end_date" class="form-input" placeholder="Data de conclusão da turma"
                   @error('end_date') is-invalid @enderror required aria-describedat="end_dateHelp">
        </fieldset>
        <div class="form-group">
            <button type="submit">Adicionar
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </button>
        </div>
    </form>
    <form action="{{ route('classrooms.import') }}" method="POST" enctype="multipart/form-data" id="importForm"
          style="display: none;" class="create-form">
        @csrf
        <label for="file" class="form-label"><h1>Adicionar turma e formandos</h1></label>
        <div class="form-group">
            <a href="{{ asset('templates/AddTurmaEAlunos.xlsx') }}" download>Download do Template Excel</a>
        </div>
        <div class="form-group">
            <input type="file" name="file" id="file" accept=".xlsx,.xls" required class="form-input">
        </div>
        <div class="form-group">
            <button type="submit">Enviar
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </form>
</div>
