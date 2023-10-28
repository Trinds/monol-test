<div class="container">
    <h1 class="title">Editar Formando</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ocorreram alguns problemas com os campos preenchidos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{url('students/' . $student->id)}}" method="POST" enctype="multipart/form-data" class="create-form">
        @csrf
        @method('PUT')

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">1</span> Informação do curso <i
                    class="fa-solid fa-bookmark form-icon"></i></legend>
            <label for="course_id" class="form-label">Curso:</label>
            <select name="course_id" id="course_id" class="form-control-select">
                <option value="">Selecione...</option>
                @foreach ($courses as $course)
                    <option
                        value="{{ $course->id }}" {{ $course->id == $student->classroom->course_id ? 'selected' : '' }}>{{ $course->abbreviation }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset class="fieldset">
            <legend class="legend"><span class="number">2</span> Informação da turma <i
                    class="fa-solid fa-users form-icon"></i></legend>
            <label for="classroom_id" class="form-label">Turma:</label>
            <select name="classroom_id" id="classroom_id" class="form-control-select">
                <option value="">Selecione...</option>
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}"
                            data-course="{{ $classroom->course_id }}" {{ $classroom->id == $student->classroom_id ? 'selected' : '' }}>
                        {{ $classroom->edition }}
                    </option>
                @endforeach
            </select>
        </fieldset>
        <fieldset class="fieldset">
            <legend class="legend"><span class="number">3</span> Informação do formando <i
                    class="fa-solid fa-user-graduate form-icon"></i></legend>

            <label for="student_number" class="form-label">Numero de Formando:</label>
            <input type="text" id="student_number" name="student_number" class="form-input"
                   placeholder="Numero do Formando" value="{{ $student->student_number }}" required>

            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="Email do Formando"
                   value="{{ $student->email }}" required>

            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="Nome do Formando"
                   value="{{ $student->name }}" required>

            <label for="birth_date" class="form-label">Data de nascimento:</label>
            <input type="date" id="birth_date" name="birth_date" class="form-input"
                   placeholder="Data de nascimento do formando" value="{{ $student->birth_date }}" required>

            <label for="image" class="form-label">Foto:</label>
            <input type="file" id="image" name="image" class="form-input" placeholder="Imagem do formando">
        </fieldset>
        <div class="form-group">
            <button type="submit">Atualizar
                <i class="fa-regular fa-pen-to-square"></i>
            </button>

        </div>
    </form>
</div>
