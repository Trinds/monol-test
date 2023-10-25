@if ($students)
<div class="table-container">        
    <form method="POST" id = "gradesForm" action="{{ url('evaluations') }}">
        @csrf
        <table>
            <thead>
                <tr class="table-header">
                    <th scope="col">Nome</th>
                    <th scope="col">Turma</th>
                    <th scope="col">Nota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr class="table-row">
                    <td>{{ $student->name }}</td>
                    <td>
                        {{ $student->classroom->course->abbreviation }} {{ $student->classroom->edition }}
                    </td>
                    <td>
                    <input type="number" name="grades" student_Id="{{ $student->id }}" studentstep="0.01" min="0" max="20">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <input type="hidden" name="grades" id="grades" value="">
        <div id="insert_button">
            <button type="button" id="submit-grades">Inserir Pauta</button>
        </div>
    </form>
</div>
@endif