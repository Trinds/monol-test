<div class="title">
    <h1>Lista de Utilizadores</h1>
</div>
<div class="table-container">
    <table id="usersTable">
        <thead>
            <tr class="table-header">
                <th scope="col"></th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Função</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="table-row">
                <td>

                    @if($user->image !== null)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Fotografia" style="height: 50px"/>
                    @else

                    <img src="{{ asset('imgs/defaultuser.png') }}" alt="{{ $user->name }} Profile Image"/>
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                    {{ Str::ucfirst($role->name) }}
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}"><i class="fa-solid fa-magnifying-glass detailsBtn"></i></a>
                    <a href="{{ route('users.edit', $user->id) }}"><i class="fa-solid fa-pencil editBtn"></i></a>
                    <a onclick="event.preventDefault(); document.getElementById('userRmvForm{{$user->id}}').submit();">
                        <i class="fa-regular fa-trash-can removeBtn"></i>
                    </a>
                    <form id="userRmvForm{{$user->id}}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
