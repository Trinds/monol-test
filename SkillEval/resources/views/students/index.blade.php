@extends('master.main')

    @section('styles')
    <link rel="stylesheet" href="{{asset('css/students.css')}}">
@endsection

@section('content')

    <form method="get" action="/students">
        @csrf
        <label for="classroomFilter">Turma</label>
        <select class="form-control" id="classroomFilter" name="classroomFilter" onchange="this.form.submit()">
            <option value="0">Escolha</option>
            @foreach ($classrooms as $classroom)
            <option value={{$classroom->id}} {{old('classroom')}}>{{$classroom->course->abbreviation . $classroom->edition}}</option>

            @endforeach
        </select>
    </form>

    @component('components.students.students-table', ['students' => $students] )

    @endcomponent

@endsection
