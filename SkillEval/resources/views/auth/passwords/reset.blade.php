<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Reset Password</title>
</head>
<body>
<div class="login-background">
    <div class="login-card">
        <div class="app-title">
            <svg width="6" height="39" viewBox="0 0 6 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 0L3 39" stroke="#F8D442" stroke-width="6"/>
            </svg>
            <h1>{{ __('Reset Password') }}</h1>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}" class="login-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <label class="login-form-input-name" for="email">{{ __('E-Mail Address') }}

                    <input id="email"
                           type="email"
                           class="login-form-input-field form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ $email ?? old('email') }}" required autocomplete="off" autofocus>
                </label>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                @enderror
                <label for="password" class="login-form-input-name">{{ __('Password') }}
                    <input id="password" type="password"
                           class="login-form-input-field form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">
                </label>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <label for="password-confirm" class="login-form-input-name">{{ __('Confirme Password') }}
                    <input id="password-confirm" type="password" class="login-form-input-field form-control"
                           name="password_confirmation" required autocomplete="new-password">
                </label>
                <button type="submit" class="login-form-submit-button">
                    {{ __('Reset Password') }}
                </button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>

