<div class="top-bar">
    <form method="get" action="/{{ $dir }}">
        @csrf
        <div class="search-input">
            <input type="search" name="searchParam" id="searchParam" class="custom-icon" placeholder="Pesquisar..."
                   value={{request('searchParam')}}>
        </div>
        @if(isset($filterName))
            <div>
                <label for="filter">{{$filterName}}</label>
                <select class="form-control" id="filter" name="filter" onchange="this.form.submit()">
                    <option onselect="{{ route($dir.'.index') }}"
                            value="">{{ isset($classrooms) ? 'Todas' : 'Todos' }} </option>
                    @if( isset($classrooms) && $dir=='students' )
                        @foreach ($classrooms as $classroom)
                            <option
                                value="{{ $classroom->id }}" {{ request('filter') == $classroom->id ? 'selected' : '' }}>{{ $classroom->course->abbreviation . $classroom->edition }}</option>
                        @endforeach
                    @endif
                    @if( isset($courses)  && $dir=='classrooms' )
                        @foreach ($courses as $course)
                            <option
                                value="{{ $course->id }}" {{ request('filter') == $course->id ? 'selected' : '' }}>{{ $course->abbreviation }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        @endif
    </form>
    <button onclick="location.href = '{{ route($dir.'.create') }}'">Criar {{ $createBtnName }}</button>
</div>
