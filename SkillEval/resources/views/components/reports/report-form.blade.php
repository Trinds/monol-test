<div class="report-form-container">
    <form action="{{ route('reports.index') }}" method="GET">
        <div class="row">
            <div class="col-md-3">
                <div class="p-4 border border-1 rounded-lg shadow-lg">
                    <p class="text-center font-weight-bold">Filtrar Turmas</p>
                    <div class="form-group">
                        <label for="courseDropdown">Curso</label>
                        <select id="course_id" name="course_id" class="form-control">
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
                        <select id="classroom_id" name="classroom_edition" class="form-control"
                                onchange="this.form.submit()">
                            <option value="" selected>Selecionar Turma</option>
                            @foreach($classrooms as $classroom)
                                <option
                                    value="{{ $classroom->edition }}"
                                    data-course="{{$classroom->course->abbreviation}}"
                                    {{ (old('classroom_edition', request('classroom_edition')) == $classroom->edition) ? 'selected' : '' }} >
                                    {{ $classroom->edition }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-4 border border-1 rounded-lg shadow-lg">
                    <p class="text-center font-weight-bold">Filtrar Datas</p>
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

            </div>

            <div class="col-md-3">
                <div class="p-4 border border-1 rounded-lg shadow-lg">
                    <p class="text-center  font-weight-bold">Avaliação Técnica</p>
                    <div class="form-group">
                        <label for="min_average_tec font-weight-bold">Média Mínima</label>
                        <input type="number" id="min_average_tec" name="min_average_tec"
                               value="{{ request('min_average_tec') }}" class="form-control" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="max_average_tec font-weight-bold">Média Máxima</label>
                        <input type="number" id="max_average_tec" name="max_average_tec"
                               value="{{ request('max_average_tec') }}" class="form-control" step="0.01">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-4 border border-1 rounded-lg shadow-lg">
                    <p class="text-center font-weight-bold">Avaliação Psicotécnica</p>
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
        </div>
        <button class="shadow-lg " type="submit">Atualizar <i class="fa-solid fa-arrows-rotate"></i></button>
    </form>
</div>
