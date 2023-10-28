<div class="container">
    <h1 class="title">Criar Utilizador</h1>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="create-form">
        @csrf

        @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                <ul>
                    @if (session('error'))
                        <li> {{ session('error') }}</li>
                    @endif
                    <br>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">1</span> Dados Pessoais <i
                    class="fa-regular fa-address-card form-icon"></i></legend>
            <label for="name" class="form-label">Nome</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="Nome do utilizador" required
                   value="{{ old('name') }}" aria-describedat="nameHelp">
            <small id="nameHelp" class="form-text text-muted">Ex: João Silva</small>

            <label for="image" class="form-label">Foto de perfil</label>
            <input type="file" id="image" name="image" class="form-input" placeholder="Foto de perfil do utilizador"
                   aria-describedat="imageHelp">

        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">2</span> Credenciais <i class="fa-solid fa-gears form-icon"></i>
            </legend>

            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="E-mail do utilizador"
                   required value="{{ old('email') }}" aria-describedat="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Ex: User@edu.atec.pt</small>

            <label for="password" class="form-label">Password</label>
            <div class="password-field">
                <input type="password" id="password" name="password" class="form-input"
                       placeholder="Password do utilizador"
                       required value="{{ old('password') }}" aria-describedat="passwordHelp">
                <span class="input-group-btn">
                    <button class="btn btn-default reveal-password" type="button">
                        <i class="fas fa-eye"></i>
                    </button>
                </span>
            </div>
            <small id="passwordHelp" class="form-text text-muted">Ex: 12345678</small>

            <label for="password_confirmation" class="form-label">Confirmação da Password</label>
            <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                       placeholder="Confirmação da Password do utilizador" required
                       value="{{ old('password_confirmation') }}"
                       aria-describedat="password_confirmationHelp">
            </div>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">3</span> Funções <i class="fa-solid fa-briefcase form-icon"></i>
            </legend>
            <label for="roles" class="form-label">Funções:</label>
            <select name="roles[]" id="roles" class="form-control-select" multiple required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ Str::ucfirst($role->name)}}</option>
                @endforeach
            </select>
        </fieldset>

        <div class="form-group">
            <button type="submit">Adicionar
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </button>
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
