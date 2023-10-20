<div class="student-card">
    <h1>{{$student->name}}</h1>
    @if($student->image !== null)
    <img src="{{ asset('storage/' . $student->image) }}" alt="Fotografia" style="height: 150px; width:150px; border-radius: 50%;"/>
    @else
    <img src="{{ asset('imgs/defaultuser.png') }}" alt="{{ $student->name }} Profile Image"/>
    @endif

    <label>Email:<input type="text" value="{{$student->email}}" disabled></label>
    <label>Turma:<input type="text" value="{{$student->classroom->course->abbreviation . $student->classroom->edition}}" disabled></label>
    <label>Nº Aluno:<input type="text" value="{{$student->student_number}}" disabled></label>
    <label>Data de nascimento:<input type="text" value="{{date('d-m-Y', strtotime($student->birth_date))}}" disabled></label>
</div>
