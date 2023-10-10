<aside class="side-menu">

    <div class="app-title">
        <svg width="6" height="39" viewBox="0 0 6 39" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 0L3 39" stroke="#F8D442" stroke-width="6"></path>
        </svg>
        <p>ATEC SkillEval</p>
    </div>
<ul id="userInfo">
    @if (Auth::user())
    <li>
        @if(Auth::user()->image !== null)
        <div>
            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }} Profile Image">
        </div>
        @endif
    </li>
    <li id="userName">
        <p>{{ Auth::user()->name }}</p>
    </li>
    <li id="userRole">
        @foreach(Auth::user()->roles as $role)
        <p>{{ $role->name }} </p>
        @endforeach
    </li>
    @endif
</ul>
    <ul id="menu">
        <li onclick="goToHome()" id="toHome"><div class="icon"><i class="fa fa-home"></i></div>Início</li>
        <li onclick="goToCourses()" id="toCourses"><div class="icon"><i class="fa-regular fa-bookmark"></i></div>Cursos</li>
        <li onclick="goToClassrooms()" id="toClassrooms"><div class="icon"><i class="fa-solid fa-users"></i></div>Turmas</li>
        <li onclick="goToStudents()" id="toStudents"><div class="icon"><i class="fa-solid fa-user-graduate"></i></div>Formandos</li>
        <li id="toReports"><div class="icon"><i class="fa fa-flag"></i></div>Relatórios</li>
        <li id="toEvaluations"><div class="icon"><i class="fa-solid fa-check"></i></div>Avaliações</li>
    </ul>

    <ul id="sair">
        <li id="toLogout"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            SAIR
            <div class="icon">
                <i class="fa-solid fa-arrow-right-from-bracket" ></i>
            </div>
        </li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>


</aside>


<script type="text/javascript">
    function goToHome(){
        location.href = "{{route('home')}}"
    }
    function goToCourses(){
        location.href = "{{route('courses.index')}}"
    }
    function goToStudents(){
        location.href = "{{route('students.index')}}"
    }
    function goToClassrooms(){
        location.href = "{{route('classrooms.index')}}"
    }
</script>
