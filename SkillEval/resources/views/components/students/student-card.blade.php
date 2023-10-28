<div class="student-card">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ocorreram alguns problemas com os campos preenchidos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('students.update', ['student' => $student]) }}" enctype="multipart/form-data">
        <fieldset>
            @csrf
            @method('PUT')
            <h1 id="studentNameH1">{{$student->name}}</h1>
            @if($student->image !== null)
                <img class='user-img' src="{{ asset('storage/' . $student->image) }}" alt="Fotografia"
                     style="height: 150px; width:150px; border-radius: 50%;"/>
            @else
                <img class='fa-regular fa-circle-user user-img' src="{{ asset('imgs/defaultuser.png') }}"
                     alt="{{ $student->name }} Profile Image"/>
            @endif
            <label for="name" id="studentNameInput" hidden>Nome: <input type="text" name="name"
                                                                        value="{{$student->name}}"></label>
            <label id="studentImageInput" hidden>Foto:<input type="file" name="image" id="image"></label>
            <label>Email:<input type="text" name="email" id="email" value="{{$student->email}}" readonly></label>
            <label id=studentClassroomView>Turma:<input type="text"
                                                        value="{{$student->classroom->course->abbreviation . $student->classroom->edition}}"
                                                        readonly></label>
            <div id="classroomDropdowns" hidden>
                <label> Curso:
                    <select class="selectForm" id="course_id">
                        @foreach($courses as $course)
                            <option value="{{$course->id}}"
                                    @if ($course->abbreviation === $student->classroom->course->abbreviation)
                                        selected
                                @endif
                            >{{$course->abbreviation}}</option>
                        @endforeach
                    </select>
                </label>
                <label>Edição:
                    <select class="selectForm" name="classroom_id" id="classroom_id">
                        @foreach($classrooms as $classroom)
                            <option value="{{$classroom->id}}" data-course="{{$classroom->course_id}}"
                                    @if ($classroom->edition === $student->classroom->edition)
                                        selected
                                @endif
                            >{{$classroom->edition}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <label>Nº Aluno:<input type="text" name="student_number" value="{{$student->student_number}}"
                                   id="studentNumberInput" readonly></label>
            <label id="birthDateView">Data de nascimento:<input type="text"
                                                                value="{{date('d-m-Y', strtotime($student->birth_date))}}"
                                                                readonly></label>
            <label for="birth_date" id="birthDateInput" hidden>Data de nascimento <input type="date" name="birth_date"
                                                                                         value="{{$student->birth_date}}">
            </label>
            <button type="submit" id="buttonSave" hidden>Guardar</button>
        </fieldset>
    </form>
    <button id="buttonCancel" hidden>Cancelar</button>
    <button id="buttonEdit">Editar</button>
</div>
