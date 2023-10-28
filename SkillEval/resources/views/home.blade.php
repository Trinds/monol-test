@extends('master.main')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.js"></script>
@endsection

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="dashboard-container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="cards-container">
            @component('components.dashboard.dashboard-card', [
            'backgroundClass' => 'background-gradient-light-orange',
            'count' => $studentsCount,
            'name' => 'Formandos',
            'iconClass' => 'fa-solid fa-user-graduate fa-2xl',
            'dir' => route('students.index'),
            ])
            @endcomponent

            @component('components.dashboard.dashboard-card', [
            'backgroundClass' => 'background-gradient-light-blue',
            'count' => $classrooms->count(),
            'name' => 'Turmas',
            'iconClass' => 'fa-solid fa-users fa-2xl',
            'dir' => route('classrooms.index'),
            ])
            @endcomponent

            @component('components.dashboard.dashboard-card', [
            'backgroundClass' => 'background-gradient-dark-orange',
            'count' => $coursesCount,
            'name' => 'Cursos',
            'iconClass' => 'fa-regular fa-bookmark fa-2xl',
            'dir' => route('courses.index'),
            ])
            @endcomponent

            @Auth
                @if (Auth::user()->roles->contains('name', 'admin'))
                    @component('components.dashboard.dashboard-card', [
                    'backgroundClass' => 'background-gradient-dark-blue',
                    'count' => $usersCount,
                    'name' => 'Utilizadores',
                    'iconClass' => 'fa-regular fa-id-card fa-2xl',
                    'dir' => route('users.index'),
                    ])
                    @endcomponent
                @endif
            @endauth
        </div>

        <div class="dashboard-chart-container">
            <div class="dashboard-chart">
                <label for="donutChart" id="AlunosPCurso" class="subtitle">Alunos por Curso</label>
                <div class="charts">
                    @component('components.dashboard.dashboard-chartAlunosCurso', [
                    'Turmas'=> $classrooms, //Array de Turmas
                    'dir' => route('courses.index'),
                    ])
                    @endcomponent
                </div>
            </div>
            <div class="dashboard-chart">
                <label for="myPieChart" id="TurmasPCurso" class="subtitle">Turmas por Curso</label>
                <div class="charts">
                    @component('components.dashboard.dashboard-ChartTurmasCurso', [
                    'Turmas'=> $classrooms, //Array de Turmas
                    'dir' => route('courses.index'),
                    ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection
