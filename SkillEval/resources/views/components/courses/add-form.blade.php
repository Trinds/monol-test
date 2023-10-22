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
@if(session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif

    <form action="{{ url('courses') }}" method="POST">
        @csrf
        <h1>Adicionar curso</h1>

        <fieldset>
            <legend><span class="number">1</span> Informação do Curso</legend>

            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control"
            placeholder="Nome do curso"
            @error('name')
            is-invalid
            @enderror
            value="{{old('name')}}"
            required
            aria-describedat="nameHelp">
            <small id="nameHelp" class="form-text text-muted">Ex: Técnico Programação e Sistemas de Informação</small>
        
            <label for="abbreviation">Sigla:</label>
            <input type="text" id="abbreviation" name="abbreviation"
            class="form-control"
            placeholder="Sigla do curso"
            @error('abbreviation')
            is-invalid
            @enderror
            required
            aria-describedat="abbreviationHelp">
            <small id="abbreviationHelp" class="form-text text-muted">Ex: TPSI</small>
        
        </fieldset>
        <div class="form-group">
        <button type="submit">Adicionar</button>
        </div>
    </form>
</div>
