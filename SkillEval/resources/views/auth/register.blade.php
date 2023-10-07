<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Register</title>
</head>

<body>
    <div class="login-background">
        <div class="login-card">
            <div class="app-title">
                <svg width="6" height="39" viewBox="0 0 6 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 0L3 39" stroke="#F8D442" stroke-width="6" />
                </svg>
                <h1>ATEC SkillEval</h1>
            </div>
            <form class="login-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <p class="login-form-input-name">Nome</p>
                <input id="name" type="text" placeholder="Nome" class="login-form-input-field form-control"
                    name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </label>
                <p class="login-form-input-name">Email</p>
                <input id="email" type="email" placeholder="Email" class="login-form-input-field form-control"
                    name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </label>
                <label for="image" class="login-form-input-name">{{ __('Foto de perfil') }}</label>
                <input id="image" type="file" class="form-control" name="image" accept="image/*">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <p class="login-form-input-name">Password</p>
                <input id="password" type="password" placeholder="Password" class="login-form-input-field form-control"
                    name="password" required autocomplete="off">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </label>
                <label>
                    <p class="login-form-input-name">Confirmar Password</p>
                    <input id="password-confirm" type="password" placeholder="Confirmar Password"
                        class="login-form-input-field form-control" name="password_confirmation" required
                        autocomplete="off">
                </label>
                <select name="roles[]" id="roles" multiple class="form-control" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="login-form-submit-button">Registar</button>
            </form>
        </div>
    </div>
</body>

</html>
