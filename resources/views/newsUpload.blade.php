<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление новости</title>
    <link href="{{ asset('css/newsUploadStyle.css') }}" rel="stylesheet">
</head>
<body>
@include('components.header')
<div class="container">
    <div class="content_div">
    @if(Auth::user()->status == 'admin')
    <h1>Добавить новость</h1>
    @else
    <h1>Предложить новость</h1>
    @endif
    <form action="upload" method="post" enctype="multipart/form-data" class="form">
        @csrf
        <input type="text" name="title" placeholder="Заголовок новости" value="{{ old('title') }}">
        @error('title')
        <p class="error">{{ $message }}</p>
        @enderror
        <input type="file" name="img" id="file_upload" onChange="show_name()" value="{{ old('img') }}">
        <label for="file_upload" class="custom-file-upload">
        Изображение
        </label>
        @error('img')
        <p class="error">{{ $message }}</p>
        @enderror
        <textarea name="text" placeholder="Текст новости" value="{{ old('text') }}"></textarea>
        @error('text')
        <p class="error">{{ $message }}</p>
        @enderror
        <select name="category">
            <option>Спорт</option>
            <option>Регион</option>
            <option>Культура</option>
            <option>Проекты</option>
        </select>
        @if(Auth::user()->status == 'admin')
        <button type="submit" class="add_news_btn">Добавить новость</button>
        @else
        <button type="submit" class="add_news_btn">Предложить новость</button>
        @endif       
    </form>
    @if(session('success_message') !== null)
        <p class="success">{{ session('success_message') }}<p>
        <p class="success">{{ Session::forget('success_message') }}</p>
    @endif
    </div>
</div>
<script>
let fileInput = document.getElementById('file_upload');
let fileLabel = document.querySelector('.custom-file-upload');

fileInput.onchange = () => {
  fileLabel.textContent = fileInput.files.length ? fileInput.files[0].name : 'Изображение';
};
</script>
</body>
</html>