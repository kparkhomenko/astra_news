<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link href="{{ asset('css/loginStyle.css') }}" rel="stylesheet">
</head>
<body>
    @include('components.header')
    <div class="container">
    <h1>Добро пожаловать!</h1>
    <form action="login" method="post">
        @csrf
        <div>
        <input type="text" name="email" placeholder="Email">
        @error('email')
        <p class="error">{{ $message }}</p>
        @enderror
        </div>
        <div>
        <input type="password" name="password" placeholder="Пароль">
        @error('password')
        <p class="error">{{ $message }}</p>
        @enderror
        </div>
        <button type="submit" class="login_btn">Авторизация</button>
        @error('formError')
        <p class="special_error">{{ $message }}</p>
        @enderror
        <div class="register_msg">
        <p>Нет аккаунта? Создайте</p><a href="/register">новый!</a>
        </div>
    </form>
    </div>
</body>
</html>