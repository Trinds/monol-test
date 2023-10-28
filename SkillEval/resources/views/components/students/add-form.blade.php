<div class="container">
    <h1 class="title">Adicionar Formando</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ocorreram alguns problemas com os campos preenchidos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ url('students') }}" method="POST" enctype="multipart/form-data" class="create-form">
        @csrf
        <fieldset class="fieldset">
            <legend class="legend"><span class="number">1</span> Informação do curso <i
                    class="fa-solid fa-bookmark form-icon"></i></legend>
            <label for="course_id" class="form-label">Curso:</label>
            <select name="course_id" id="course_id" class="form-control-select">
                <option value="">Selecione...</option>
                @foreach ($courses as $course)
                    <option value="{{$course->id}}">{{$course->abbreviation}}</option>
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
                    <option value="{{$classroom->id}}"
                            data-course="{{$classroom->course_id}}">{{$classroom->edition}}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">3</span> Informação do formando <i
                    class="fa-solid fa-user-graduate form-icon"></i></legend>

            <label for="student_number" class="form-label">Número de formando:</label>
            <input type="text" id="student_number" name="student_number" class="form-input"
                   placeholder="Número do formando"
                   @error('student_number')
                   is-invalid
                   @enderror
                   value="{{old('student_number')}}"
                   required
                   aria-describedat="student_numberHelp">

            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email"
                   class="form-input"
                   placeholder="Email do formando"
                   @error('email')
                   is-invalid
                   @enderror
                   required
                   aria-describedat="emailHelp">

            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name"
                   class="form-input"
                   placeholder="Nome do formando"
                   @error('name')
                   is-invalid
                   @enderror
                   required
                   aria-describedat="nameHelp">

            <label for="birth_date">Data de nascimento:</label>
            <input type="date" id="birth_date" name="birth_date"
                   class="form-input"
                   placeholder="Data de nascimento do formando"
                   @error('birth_date')
                   is-invalid
                   @enderror
                   required
                   aria-describedat="birth_dateHelp">

            <label for="image">Foto:</label>
            <input type="file" id="image" name="image"
                   class="form-input"
                   placeholder="Imagem do formando"
                   @error('image')
                   is-invalid
                   @enderror
                   aria-describedat="imageHelp">
        </fieldset>
        <div class="form-group">
            <button type="submit">Adicionar
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </button>
        </div>
    </form>
</div>
