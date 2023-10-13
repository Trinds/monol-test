@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/topbar.css')}}">
@endsection

@section('content')
<form action="{{ route('classrooms.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="file">Selecione o arquivo Excel:</label>
        <input type="file" name="file" id="file" accept=".xlsx">
    </div>
    <button type="submit">Enviar</button>
</form>

    @component('components.topbar',[
    'dir'           => 'classrooms',
    'createBtnName' => 'Turma',
    'courses'       => $courses,
    'filterName'    => 'Curso'
    ])
    @endcomponent

    @component('components.classrooms.table', ['classrooms' => $classrooms])
    @endcomponent

@endsection
