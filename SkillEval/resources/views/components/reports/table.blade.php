<form action="{{ route('reports.index') }}" method="GET">
    <label for="start_date">Start Date:</label><br>
    <input type="date" id="start_date" name="start_date" placeholder="Start Date" value="{{ request('start_date') }}">
    
    <br><br><br><br>
    <label for="end_date">End Date:</label><br>
    <input type="date" id="end_date" name="end_date" placeholder="End Date" value="{{ request('end_date') }}">
    <br>
    <button type="submit">Filter</button>
</form>


<div class="chart_container">
    <div class="container">
        <h1>Classroom Reports</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Classroom Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->edition }}</td>
                        <td>{{ $classroom->start_date }}</td>
                        <td>{{ $classroom->end_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>