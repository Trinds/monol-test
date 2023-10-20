<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ups!</strong> Ocorreram alguns problemas com os campos preenchidos.<br><br>
    </div>
    @endif
    <form action="{{url('students/' . $student->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h1>Editar Aluno</h1>

        <fieldset>
            <legend><span class="number">1</span> Informação do Curso</legend>
            <label for="course_id">Curso:</label>
            <select name="course_id" id="course_id" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($courses as $course)
                <option value="{{ $course->id }}" {{ $course->id == $student->classroom->course_id ? 'selected' : '' }}>{{ $course->abbreviation }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <legend><span class="number">2</span> Informação da Turma</legend>
            <label for="classroom_id">Turma:</label>
            <select name="classroom_id" id="classroom_id" class="form-control">
                <option value="">Selecione...</option>
                @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}" data-course="{{ $classroom->course_id }}" {{ $classroom->id == $student->classroom_id ? 'selected' : '' }}>
                    {{ $classroom->edition }}
                </option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <legend><span class="number">3</span> Informação do Aluno</legend>

            <label for="student_number">Numero de Formando:</label>
            <input type="text" id="student_number" name="student_number" class="form-control" placeholder="Numero do Formando" value="{{ $student->student_number }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email do Formando" value="{{ $student->email }}" required>

            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do Formando" value="{{ $student->name }}" required>

            <label for="birth_date">Data de nascimento:</label>
            <input type="date" id="birth_date" name="birth_date" class="form-control" placeholder="Data de nascimento do formando" value="{{ $student->birth_date }}" required>

            <label for="image">Foto:</label>
            <input type="file" id="image" name="image" class="form-control" placeholder="Imagem do formando">
        </fieldset>
        <div class="form-group">
            <button type="submit">Atualizar</button>
        </div>
    </form>
</div>