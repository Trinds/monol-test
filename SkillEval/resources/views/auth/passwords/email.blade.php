<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<div class="login-background">
    <div class="login-card">
        <div class="app-title">
            <svg width="6" height="39" viewBox="0 0 6 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 0L3 39" stroke="#F8D442" stroke-width="6"/>
            </svg>
            <h1>Reset Password</h1>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form class="login-form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <label for="email" class="login-form-input-name">{{ __('Enderço de e-mail') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email"
                           class="login-form-input-field form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="login-form-submit-button">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Enviar link de recuperação') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
