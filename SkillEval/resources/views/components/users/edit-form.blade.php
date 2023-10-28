<div class="container">
    <h1 class="title">Editar Utilizador</h1>
    <form action="{{ url('users/' . $user->id) }}" method="POST" enctype="multipart/form-data" class="create-form">
        @csrf
        @method('PUT')

        @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                <ul>
                    @if (session('error'))
                        <li>{{ session('error') }}</li>
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
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="Nome do utilizador"
                   @error('name')
                   is-invalid
                   @enderror value="{{ $user->name }}" required
                   aria-describedat="nameHelp">
            <label for="image" class="form-label">Foto de perfil</label>
            <input type="file" id="image" name="image" class="form-input" placeholder="Foto de perfil do utilizador"
                   @error('image')
                   is-invalid
                   @enderror value="{{ $user->image }}"
                   aria-describedat="imageHelp">
        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend"><span class="number">2</span> Credenciais <i class="fa-solid fa-gears form-icon"></i>
            </legend>

            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="E-mail do utilizador"
                   @error('email') is-invalid @enderror value="{{ $user->email }}" required
                   aria-describedat="emailHelp">

            @if ($user->id === auth()->user()->id)
                <label for="password" class="form-label">Password</label>
                <div class="input-group password-input">
                    <input type="password" id="password" name="password" class="form-input"
                           placeholder="Password do utilizador" @error('password') is-invalid @enderror value=""
                           aria-describedat="passwordHelp" style="width: 94.5%">
                    <span class="input-group-btn">
                    <button class="btn btn-default reveal-password" type="button" id="showPassBtn">
                        <i class="fas fa-eye"></i>
                    </button>
                </span>
                </div>

                <label for="password_confirmation" class="form-label">Confirmação da Password</label>
                <div class="input-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                           placeholder="Confirmação da Password do utilizador"
                           @error('password_confirmation') is-invalid @enderror value=""
                           aria-describedat="password_confirmationHelp">
                </div>
            @endif
        </fieldset>

        <fieldset class="fieldset">
            @if (auth()->user()->isAdmin())
                <legend class="legend"><span class="number">3</span> Funções <i
                        class="fa-solid fa-briefcase form-icon"></i></legend>
                <label for="roles" class="form-label">Funções:</label>
                <select name="roles[]" id="roles" class="form-control-select" multiple>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if ($user->roles->contains($role)) selected @endif>
                            {{ Str::ucfirst($role->name)}}</option>
                    @endforeach
                </select>
        </fieldset>
        @else
            <input type="hidden" name="roles[]" value="2">
        @endif

        <div class="form-group button-container">
            <button type="submit">Editar <i class="fa-solid fa-user-pen"></i></button>
            <button type="button" id="cancel-button"><i class="fa-solid fa-circle-arrow-left"></i> Voltar</button>
        </div>
    </form>
</div>


<script>
    $(document).ready(function () {


        $("#cancel-button").on("click", function () {
            window.history.back();
        });

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
