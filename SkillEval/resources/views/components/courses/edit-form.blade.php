<div class="container">
    <h1 class="title">Editar curso</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ocorreram alguns problemas com os campos preenchidos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ url('courses/' . $course->id) }}" method="POST" class="create-form">
        @csrf
        @method('PUT')
        <fieldset class="fieldset">
            <legend class="legend"><span class="number">1</span> Informação do Curso <i
                    class="fa-solid fa-bookmark form-icon"></i></legend>
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-input"
                   placeholder="{{ $course->name }}"
                   @error('name')
                   is-invalid
                   @enderror
                   required
                   value="{{$course->name}}"
                   aria-describedat="nameHelp">
            <small id="nameHelp" class="form-text text-muted">Ex: Técnico Programação e Sistemas de Informação</small>

            <label for="abbreviation" class="form-label">Sigla:</label>
            <input type="text" id="abbreviation" name="abbreviation"
                   class="form-input"
                   placeholder="{{$course->abbreviation}}"
                   @error('abbreviation')
                   is-invalid
                   @enderror
                   value="{{$course->abbreviation}}"
                   required
                   aria-describedat="abbreviationHelp">
            <small id="abbreviationHelp" class="form-text text-muted">Ex: TPSI</small>

        </fieldset>

        <div class="form-group">
            <button type="submit">Atualizar
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
        </div>

    </form>
</div>
