<div class="container">        
    <form action="{{ url('students') }}" method="POST">
        @csrf
        <h1>Adicionar Aluno</h1>

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
        <label for="classroom_id">Turma:</label>
        <select name="classroom_id" id="classroom_id" class="form-control">
        @foreach ($classrooms as $classroom)
            <option value="{{$classroom->id}}" data-course="{{$classroom->course_id}}">{{$classroom->edition}}</option>
        @endforeach
        </select>
        </fieldset>

        <fieldset>
            <legend><span class="number">3</span> Informação do Aluno</legend>

            <label for="student_number">Edição:</label>
            <input type="text" id="student_number" name="student_number" class="form-control"
            placeholder="Numero do Formando"
            @error('student_number')
            is-invalid
            @enderror
            value="{{old('student_number')}}"
            required
            aria-describedat="student_numberHelp">
            <small id="student_numberHelp" class="form-text text-muted">Ex: T0123456</small>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
            class="form-control"
            placeholder="Email do Formando"
            @error('email')
            is-invalid
            @enderror
            required
            aria-describedat="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Ex:

            <label for="name">Nome:</label>
            <input type="text" id="name" name="name"
            class="form-control"
            placeholder="Nome do Formando"
            @error('name')
            is-invalid
            @enderror
            required
            aria-describedat="nameHelp">
            <small id="nameHelp" class="form-text text-muted">Ex: João Silva</small>

            <label for="birth_date">Data de nascimento:</label>
            <input type="date" id="birth_date" name="birth_date"
            class="form-control"
            placeholder="Data de nascimento do formando"
            @error('birth_date')
            is-invalid
            @enderror
            required
            aria-describedat="birth_dateHelp">
            <small id="birth_dateHelp" class="form-text text-muted">Ex: 2003-01-01</small>
            @error('birth_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="image">Imagem:</label>
            <input type="file" id="image" name="image"
            class="form-control"
            placeholder="Imagem do formando"
            @error('image')
            is-invalid
            @enderror
            aria-describedat="imageHelp">
            <small id="imageHelp" class="form-text text-muted">Ex: imagem do formando</small>
        </fieldset>
        <div class="form-group">
        <button type="submit">Adicionar</button>
        </div>
    </form>
</div>

