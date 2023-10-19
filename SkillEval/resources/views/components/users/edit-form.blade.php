<div class="container">
    <form action="{{ url('users/' . $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h1>Editar Utilizador</h1>


        @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                <ul>
                    @if (session('error'))
                        <li>{{ session('error') }}</li>
                    @endif
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <fieldset>
            <legend><span class="number">1</span>Dados Pessoais</legend>

            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do utilizador"
                @error('name')
        is-invalid
        @enderror value="{{ $user->name }}" required
                aria-describedat="nameHelp">
            <small id="nameHelp" class="form-text text-muted">Ex: João Silva</small>


            <fieldset>
                <label for="image">Foto de perfil</label>
                <input type="file" id="image" name="image" class="form-control" placeholder="Foto de perfil do utilizador"
                    @error('image')
                    is-invalid
                    @enderror value="{{ $user->image }}"
                    aria-describedat="imageHelp">
                <small id="imageHelp" class="form-text text-muted">Ex: Foto de perfil do utilizador</small>

            </fieldset>
        </fieldset>

        <fieldset>
            <legend><span class="number">2</span>Credenciais</legend>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="E-mail do utilizador"
                @error('email')
        is-invalid
        @enderror value="{{ $user->email }}" required
                aria-describedat="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Ex: User@edu.atec.pt</small>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control"
                placeholder="Password do utilizador" @error('password')
        is-invalid
        @enderror
                value="{{ $user->password }}" required aria-describedat="passwordHelp">
            <small id="passwordHelp" class="form-text text-muted">Ex: 12345678</small>


            <label for="password_confirmation">Confirmação da Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                placeholder="Confirmação da Password do utilizador"
                @error('password_confirmation')
        is-invalid
        @enderror value="{{ $user->password }}"
                required aria-describedat="password_confirmationHelp">
            <small id="password_confirmationHelp" class="form-text text-muted">Ex: 12345678</small>

        </fieldset>

        <fieldset>
            <legend><span class="number">3</span>Funções</legend>
            <label for="roles">Funções:</label>
            <select name="roles[]" id="roles" class="form-control" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if ($user->roles->contains($role)) selected @endif>
                        {{ $role->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <div class="form-group">
            <button type="submit">Editar</button>
        </div>
    </form>
</div>
