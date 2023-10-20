<div class="container">        
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Ups!</strong> Ocorreram alguns problemas com os campos preenchidos.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>- {{ $error }}</li>
        @endforeach
</div>
@endif
    <form action="{{ url('courses/' . $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h1>Editar curso</h1>

        <fieldset>
            <legend><span class="number">1</span> Informação do Curso</legend>

            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control"
            placeholder="{{ $course->name }}"
            @error('name')
            is-invalid
            @enderror
            required
            value="{{$course->name}}"
            aria-describedat="nameHelp">
            <small id="nameHelp" class="form-text text-muted">Ex: Técnico Programação e Sistemas de Informação</small>
          
            <label for="abbreviation">Sigla:</label>
            <input type="text" id="abbreviation" name="abbreviation"
            class="form-control"
            placeholder="{{$course->abbreviation}}"
            @error('abbreviation')
            is-invalid
            @enderror
            value="{{$course->abbreviation}}"
            required
            aria-describedat="abbreviationHelp">
            <small id="abbreviationHelp" class="form-text text-muted">Ex: TPSI</small>
        
        </fieldset>

        <button type="submit">Editar</button>

    </form>
</div>
