<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ошибка</title>
</head>
<body>
    @include('..components.header')
    <div class="container">
        <h1 style="margin-top: 200px; text-align: center; top:20vh; font-size: 4em;">404</h1>
        <h1 class="unfound" style=" text-align: center; top:20vh">Страница не найдена</h1>
    </div>
    @include('..components.footer')
    <style>
        @media (max-width: 1440px){
            .unfound {
                font-size: 16px;
            }      
        }
    </style>
</body>
</html>