<div class="student-card">
    <h1>{{$student->name}}</h1>
    <img class="user-img" src="{{$student->image}}" alt="User's Profile Picture">
    <label>Email:</label><input type="text" value="{{$student->email}}" disabled><br>
    <label>Turma:</label><input type="text" value="{{--{{$student->classroom->edition}}--}}" disabled><br>
    <label>Nº Aluno:</label><input type="text" value="{{$student->student_number}}" disabled><br>
    <label>Data de nascimento</label><input type="text" value="{{$student->birth_date}}" disabled><br>
</div>
