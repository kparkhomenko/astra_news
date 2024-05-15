<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="{{ asset('css/registrationStyle.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
    @include('components.header')
    <h1>Регистрация аккаунта</h1>
    <form action="{{ route('user_register') }}" method="post">
        @csrf
        <div>
        <input type="text" name="name" placeholder="ФИО пользователя" value="{{ old('name') }}">
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>
        <div>
        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>
        <div>
        <select name="district">
                <option>Ленинский район</option>
                <option>Советский район</option>
                <option>Кировский район</option>
                <option>Трусовский район</option>
        </select>
        @error('district')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>
        <div>
        <input type="password" name="password" placeholder="Пароль">
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>
        <div>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        @error('password_confirm')
            <p class="error">{{ $message }}</p>
        @enderror
        </div>
        <button type="submit" class="register_btn">Регистрация</button>
    </form>
    <div class="login_msg">
            <p>Уже есть аккаунт?</p><a href="{{ route('login') }}">Войдите!</a>
        </div>
    </div>
</body>
</html>