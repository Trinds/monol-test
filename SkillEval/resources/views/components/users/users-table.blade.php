@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if($errors->any())
    <div class="container alert alert-danger" role="alert">
        <h6><strong>Ups!</strong> Ocorreu um erro:</h6>
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif
<div class="title">
    <h1>Lista de Utilizadores</h1>
</div>
<div class="table-container">
    <table class="large-table" id="usersTable">
        <thead>
        <tr class="table-header">
            <th scope="col"></th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Função</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="table-row">
                <td>
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Fotografia"/>
                    </div>
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        {{ Str::ucfirst($role->name) }}
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}"><i
                            class="fa-solid fa-magnifying-glass detailsBtn"></i></a>
                    <a href="{{ route('users.edit', $user->id) }}"><i class="fa-solid fa-pencil editBtn"></i></a>
                    <a class="deleteBtn" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-entity="users">
                        <i class="fa-regular fa-trash-can removeBtn"></i>
                    </a>
                    <div id="confirmationBox">
                        <h2><strong>Apagar Utilizador</strong></h2>
                        <p class="confirmation-text" id="Name"></p>
                        <button id="confirmYesButton">Sim</button>
                        <button id="confirmNoButton">Não</button>
                    </div>
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
<div class="pagination-container">
    {{ $users->onEachSide(3)->links() }}
</div>
