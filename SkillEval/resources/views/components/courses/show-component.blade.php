<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div id="content">
    <div class="container">
        <div class="title">
            <h1>
                {{ $course->abbreviation }}
            </h1>
        </div>
        <div class="subtitle">
            <h3>
                {{ $course->name}}
            </h3>
        </div>
    </div>
    <div class="classroom-info">
        @foreach ($course->classrooms as $classroom)
            <div class="list-group">
                <a href="" class="list-group-item list-group-item-action flex-column align-items-start active">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$classroom->edition}}</h5>
                    <small>Criado a: {{$classroom->created_at}}</small>
                  </div>
                  <p class="mb-1">Data de começo: {{$classroom->start_date}} <br> Data de fim: {{$classroom->end_date}}</p>
                </a>
              </div>
        @endforeach
    </div>
</div>