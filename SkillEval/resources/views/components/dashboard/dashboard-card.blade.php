<div class="dashboard-card {{$backgroundClass}}" onclick="handleClick()">
    <div class="left">
        <h1>{{$count}}</h1>
        <p>{{$name}}</p>
    </div>
    <div class="right">
        <i class="{{$iconClass}}"></i>
    </div>
</div>

<script type="text/javascript">
    function handleClick(){
        location.href = "{{route($route)}}"
    }
</script>
