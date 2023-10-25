@if ($students)
    <div class="table-container">
        <table>
            <thead>
            <tr class="table-header">
                <th scope="col">Nome</th>
                <th scope="col">Turma</th>
                <th scope="col">Nota</th>
            </tr>
            </thead>
            <p id="selectedClassroomEdition"></p>
            <tbody>
            @foreach ($students as $student)
                <tr class="table-row">
                    <td>{{ $student->name }}</td>
                    <td>
                        {{ $student->classroom->course->abbreviation }} {{ $student->classroom->edition }}
                    </td>
                    <td>
                        <input type="number" name="grades[{{ $student->id }}]" step="0.01" min="0" max="20">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
