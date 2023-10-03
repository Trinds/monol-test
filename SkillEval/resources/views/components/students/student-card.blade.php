<div class="student-card">
    <h1>{{$student->name}}</h1>
    <img class="user-img" src="{{$student->image}}" alt="User's Profile Picture">
    <label>Email:<input type="text" value="{{$student->email}}" disabled></label>
    <label>Turma:<input type="text" value="{{--{{$student->classroom->edition}}--}}" disabled></label>
    <label>Nº Aluno:<input type="text" value="{{$student->student_number}}" disabled></label>
    <label>Data de nascimento:<input type="text" value="{{$student->birth_date}}" disabled></label>
</div>
