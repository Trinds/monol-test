<div class="top-bar">
    <form method="get" action="{{ $formAction }}">
        @csrf
        <div class="search-input">
            <input type="search" name="searchParam" id="searchParam" class="custom-icon" placeholder="Pesquisar...">
        </div>
        @if( isset($classrooms) && count($classrooms) > 0 )
            <div>
                <label for="classroomFilter">Turma</label>
                <select class="form-control" id="classroomFilter" name="classroomFilter" onchange="this.form.submit()">
                    <option onselect="{{ route('students.index') }}" value="0">Todas</option>
                    @foreach ($classrooms as $classroom)
                        <option value={{ $classroom->id }} {{ request('classroomFilter') == $classroom->id ? 'selected' : '' }}>{{ $classroom->course->abbreviation . $classroom->edition }}</option>
                    @endforeach
                </select>
            </div>

        @endif
    </form>
    <button onclick="location.href = '{{ $dir }}'">Criar {{ $createBtnName }}</button>
</div>
