<div class="container">
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>Criar Utilizador</h1>

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
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do utilizador" required
                value="{{ old('name') }}" aria-describedat="nameHelp">
            <small id="nameHelp" class="form-text text-muted">Ex: João Silva</small>

            <fieldset>
                <label for="image">Foto de perfil</label>
                <input type="file" id="image" name="image" class="form-control" placeholder="Foto de perfil do utilizador"
                    aria-describedat="imageHelp">
                <small id="imageHelp" class="form-text text-muted">Ex: Foto de perfil do utilizador</small>
            </fieldset>
        </fieldset>

        <fieldset>
            <legend><span class="number">2</span>Credenciais</legend>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="E-mail do utilizador"
                required value="{{ old('email') }}" aria-describedat="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Ex: User@edu.atec.pt</small>

            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password do utilizador"
                    required value="{{ old('password') }}" aria-describedat="passwordHelp">
                <span class="input-group-btn">
                    <button class="btn btn-default reveal-password" type="button">
                        <i class="fas fa-eye"></i>
                    </button>
                </span>
            </div>
            <small id="passwordHelp" class="form-text text-muted">Ex: 12345678</small>

            <label for="password_confirmation">Confirmação da Password</label>
            <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Confirmação da Password do utilizador" required value="{{ old('password_confirmation') }}"
                    aria-describedat="password_confirmationHelp">
            </div>
            <small id="password_confirmationHelp" class="form-text text-muted">Ex: 12345678</small>
        </fieldset>

        <fieldset>
            <legend><span class="number">3</span>Funções</legend>
            <label for="roles">Funções:</label>
            <select name="roles[]" id="roles" class="form-control" multiple required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <div class="form-group">
            <button type="submit">Criar</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $(".reveal-password").on("click", function () {
            var passwordInput = $("#password");
            var passwordConfirmationInput = $("#password_confirmation");
            var icon = $(this).find("i");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                passwordConfirmationInput.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                passwordConfirmationInput.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
</script>