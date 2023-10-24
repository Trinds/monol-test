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
                    <path d="M3 0L3 39" stroke="#F8D442" stroke-width="6" />
                </svg>
                <h1>ATEC SkillEval</h1>
            </div>
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <label class="login-form-input-name" for="email">Email
                    <input id="email" type="email" placeholder="Email" class="login-form-input-field form-control"
                        name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                </label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label class="login-form-input-name" for="password">Password   </label>
                    <input id="password" type="password" placeholder="Password" class="login-form-input-field form-control"
                        name="password" required autocomplete="off">
                <button type="submit" class="login-form-submit-button">Login</button>

                <div class="link-span">
                    <a href="{{ route('password.request') }}">Esqueceu-se da password?</a>
                </div>


            </form>
        </div>
    </div>
</body>
</html>
