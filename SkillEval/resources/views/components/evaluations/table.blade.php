<!-- First select element -->
<fieldset>
    <legend><span class="number">1</span> Informação do Curso</legend>
    <label for="course_id">Curso:</label>
    <select name="course_id" id="course_id" class="form-control">
        <option value="">Selecione...</option>
        @foreach ($courses as $course)
            <option value="{{$course->id}}">{{$course->abbreviation}}</option>
        @endforeach
    </select>
</fieldset>

<!-- Second select element -->
<fieldset>
    <legend><span class="number">2</span> Informação da Turma</legend>
    <label for="classroom_id">Turma:</label>
    <select name="classroom_id" id="classroom_id" class="form-control">
        <option value="">Selecione...</option>
        @foreach ($classrooms as $classroom)
            <option value="{{$classroom->id}}" data-course="{{$classroom->course_id}}">{{$classroom->edition}} </option>
        @endforeach
    </select>
</fieldset>
