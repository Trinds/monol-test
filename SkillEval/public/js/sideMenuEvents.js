function addClickEventsToSideMenu(){
    document.querySelector('#toHome').addEventListener('click',()=>{
        location.href= {{url('home')}}
    })
    document.querySelector('#toCourses').addEventListener('click',()=>{
        location.href= "{{ url('courses') }}"
    })
    document.querySelector('#toStudents').addEventListener('click',()=>{
        location.href={{url('students')}}
    })
    document.querySelector('#toClassrooms').addEventListener('click',()=>{
        location.href={{url('classrooms')}}
    })
    document.querySelector('#toReports').addEventListener('click',()=>{
        location.href={{url('reports')}}
    })
    document.querySelector('#toEvaluations').addEventListener('click',()=>{
        location.href= {{url('evaluations')}}
    })
    document.querySelector('#toLogout').addEventListener('click',()=>{
        location.href={{url('logout')}}
    })
}
