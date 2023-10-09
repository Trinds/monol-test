@extends('master.main')

    @section('styles')
    <link rel="stylesheet" href="{{asset('css/students.css')}}">
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')

    @component('components.topbar',['dir'=>route('students.create'), 'createBtnName'=>'Aluno'])
    @endcomponent

    <form method="get" action="/students">
        @csrf
        <label for="classroomFilter">Turma</label>
        <select class="form-control" id="classroomFilter" name="classroomFilter" onchange="this.form.submit()">
            <option onselect="{{ route('students.index') }}">Escolha</option>
            @foreach ($classrooms as $classroom)
                <option value={{$classroom->id}} {{ request('classroomFilter') == $classroom->id ? 'selected' : '' }}>{{$classroom->course->abbreviation . $classroom->edition}}</option>
            @endforeach
        </select>
    </form>

    @component('components.students.students-table', ['students' => $students] )

    @endcomponent

@endsection
