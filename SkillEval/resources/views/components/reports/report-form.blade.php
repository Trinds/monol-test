<div class="report-form-container">
    <form action="{{ route('reports.index') }}" method="GET">
        <div class="row">
            <div class="col-md-3 border border-1 p-2">
                <p class="text-primary">Filtrar Turmas</p>
                <div class="form-group">
                    <label for="courseDropdown">Curso</label>
                    <select id="courseDropdown" name="course_id" class="form-control" required
                            onchange="this.form.submit()">
                        <option value="">Selecionar Curso</option>
                        @foreach($courses as $course)
                            <option
                                value="{{ $course->abbreviation }}" {{ (old('course_id', request('course_id')) == $course->abbreviation) ? 'selected' : '' }}>
                                {{ $course->abbreviation }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="classroomEditionDropdown">Turma</label>
                    <select id="classroomEditionDropdown" name="classroom_edition" class="form-control" required
                            onchange="this.form.submit()">
                        <option value="">Todas as Turmas</option>
                        @foreach($classEditions as $edition)
                            <option
                                value="{{ $edition }}" {{ (old('classroom_edition', request('classroom_edition')) == $edition) ? 'selected' : '' }} >
                                {{ $edition }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3 border border-1 p-2">
                <p class="text-primary">Filtrar Datas</p>
                <div class="form-group">
                    <label for="start_date">Data de Início</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="end_date">Data de Conclusão</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                           class="form-control">
                </div>
            </div>

            <div class="col-md-3 border border-1 p-2">
                <p class="text-primary">Avaliação Técnica</p>
                <div class="form-group">
                    <label for="min_average_tec">Média Mínima</label>
                    <input type="number" id="min_average_tec" name="min_average_tec"
                           value="{{ request('min_average_tec') }}" class="form-control" step="0.01">
                </div>
                <div class="form-group">
                    <label for="max_average_tec">Média Máxima</label>
                    <input type="number" id="max_average_tec" name="max_average_tec"
                           value="{{ request('max_average_tec') }}" class="form-control" step="0.01">
                </div>
            </div>

            <div class="col-md-3 border border-1 p-2">
                <p class="text-primary">Avaliação Psíquica</p>
                <div class="form-group">
                    <label for="min_average_psi">Média Mínima</label>
                    <input type="number" id="min_average_psi" name="min_average_psi"
                           value="{{ request('min_average_psi') }}" class="form-control" step="0.01">
                </div>
                <div class="form-group">
                    <label for="max_average_psi">Média Máxima</label>
                    <input type="number" id="max_average_psi" name="max_average_psi"
                           value="{{ request('max_average_psi') }}" class="form-control" step="0.01">
                </div>
            </div>
        </div>
        <button type="submit">Atualizar</button>
    </form>
</div>