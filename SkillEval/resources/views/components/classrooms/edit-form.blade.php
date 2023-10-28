<div class="container">
    <h1 class="title">Editar Turma</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ocorreram alguns problemas com os campos preenchidos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{url('classrooms/' . $classroom->id)}}" method="POST" class="create-form">
        @csrf
        @method('PUT')
        <fieldset class="fieldset">
            <legend class="legend"><span class="number">1</span> Informação do curso <i
                    class="fa-solid fa-bookmark form-icon"></i></legend>

            <label for="course_id" class="form-label">Curso:</label>
            <select name="course_id" id="course_id" class="form-control-select">
                @foreach ($courses as $course)
                    <option value="{{$course->id}}"
                            @if($course->id == $classroom->course_id) selected @endif>{{$course->abbreviation}}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">2</span> Informação da turma <i
                    class="fa-solid fa-users form-icon"></i></legend>

            <label for="edition" class="form-label">Edição:</label>
            <input type="text" id="edition" name="edition" class="form-input" placeholder="Edição da turma"
                   @error('edition')
                   is-invalid
                   @enderror
                   value="{{$classroom->edition}}"
                   required
                   aria-describedat="editionHelp">
            <small id="editionHelp" class="form-text text-muted">Ex: 0922</small>

            <label for="start_date" class="form-label">Data de início:</label>
            <input type="date" id="start_date" name="start_date" class="form-input"
                   placeholder="Data de início da turma"
                   @error('start_date')
                   is-invalid
                   @enderror
                   value="{{$classroom->start_date}}"
                   required
                   aria-describedat="start_dateHelp">
            <small id="start_dateHelp" class="form-text text-muted">Ex: 2021-09-01</small>

            <label for="end_date" class="form-label">Data de conclusão:</label>
            <input type="date" id="end_date" name="end_date" class="form-input" placeholder="Data de conclusão da turma"
                   @error('end_date')
                   is-invalid
                   @enderror
                   value="{{$classroom->end_date}}"
                   required
                   aria-describedat="end_dateHelp">
            <small id="end_dateHelp" class="form-text text-muted">Ex: 2022-06-30</small>

        </fieldset>

        <div class="form-group">
            <button type="submit">Atualizar
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
        </div>

    </form>
</div>
