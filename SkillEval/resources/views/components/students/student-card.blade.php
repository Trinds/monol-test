<div class="student-card">
    <h1>{{$student->name}}</h1>
    @if($student->image)
        <img class='user-img' src='{{$student->image}}' alt='User Profile Picture'>
    @else
        <i class='fa-regular fa-circle-user user-img'></i>
    @endif
    <label>Email:<input type="text" value="{{$student->email}}" disabled></label>
    <label>Turma:<input type="text" value="{{$student->classroom->course->abbreviation . $student->classroom->edition}}" disabled></label>
    <label>Nº Aluno:<input type="text" value="{{$student->student_number}}" disabled></label>
    <label>Data de nascimento:<input type="text" value="{{date('d-m-Y', strtotime($student->birth_date))}}" disabled></label>
</div>
