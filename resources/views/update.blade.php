<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновить профиль</title>
    <link href="{{ asset('css/updateStyle.css') }}" rel="stylesheet">
</head>
<body>
    @include('components.header')
    <div class="container">
    <div class="content_container">
    <h1>Данные профиля</h1>
    <form action="update_user" method="post" class="form">
        @csrf
        <input type="text" name="name" value="{{ $user->name }}">
        @error('name')
        <p class="error">{{ $message }}</p>
        @enderror
        <input type="text" name="email" value="{{ $user->email }}">
        @error('email')
        <p class="error">{{ $message }}</p>
        @enderror
        <button type="submit" class="update_btn">Изменить информацию</button>
    </form>
    @if(session('success_message') !== null)
        <p class="success">{{ session('success_message') }}<p>
        <p class="success">{{ Session::forget('success_message') }}</p>
    @endif
    @error('dataError')
        <p class="special_error">{{ $message }}</p>
    @enderror
    <h1 class="password_change_title">Смена пароля</h1>
    <form action="password_change" method="post" class="form">
        @csrf
        <input type="password" name="password" placeholder="Старый пароль">
        @error('password')
        <p class="error">{{ $message }}</p>
        @enderror
        @error('passwordError')
        <p class="special_error">{{ $message }}</p>
        @enderror
        <input type="password" name="new_password" placeholder="Новый пароль">
        @error('new_password')
        <p class="error">{{ $message }}</p>
        @enderror
        <button type="submit" class="update_btn">Поменять пароль</button>
    </form>
        @if(session('success_password_message') !== null)
            <p class="success">{{ session('success_password_message') }}<p>
            <p class="success">{{ Session::forget('success_password_message') }}</p>
        @endif
    </div>
    </div>
    @include('components.footer')
</body>
</html>