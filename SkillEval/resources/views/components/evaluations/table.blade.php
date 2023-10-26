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
                <tbody>
                    @foreach ($students as $student)
                        <tr class="table-row">
                            <td>{{ $student->name }}</td>
                            <td>
                                {{ $student->classroom->course->abbreviation }} {{ $student->classroom->edition }}
                            </td>
                            <td>
                                <input type="number" name="grades[{{ $student->id }}]" min="0" max="20" step="0.1" value="0">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="insert_button">
                <button type="submit" id="submit-grades">Inserir Pauta</button>
            </div>
        </div>
    </form>
@endif