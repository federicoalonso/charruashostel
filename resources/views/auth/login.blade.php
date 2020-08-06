<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Charruas Hostel | Login</title>
</head>

<body>
    <div class="login-reg-panel">
        <div class="register-info-box" style="">
            <h2>Charruas Hostel</h2>
            <p>Administración del Hostel</p>
        </div>
        <div class="white-panel">
            <div class="login-show show-log-panel">
                <h2>LOGIN</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                    <input type="password" placeholder="Password" name="password" class="@error('password') is-invalid @enderror">
                    <input type="submit" value="Login">
                    <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>