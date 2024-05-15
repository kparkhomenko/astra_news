<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список новостей</title>
    <link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        @include('components.header')
        <div class="user_news_admin_div">
            <div class="user_news_div">
            <div class="user_news_name">
                <p>Спорт</p>
            </div>
            @if(isset($news_sport[0]))
            <div class="user_news_admin_list">
                @foreach($news_sport as $news_item)
                    <div class="news_item_div">
                    <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')">
                    <img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="298px" height="140px">
                    </a>
                    <h2>{{ $news_item->title }}</h2>
                    <p>{{ $news_item->text }}</p>
                    <button class="delete_object" onclick="deleteNews('{{ $news_item->id }}')">Удалить новость</button>
                    </div>
                @endforeach
            </div>
            @else 
            <h1 class="no_object">Нет новостей на модерацию</h1>
            @endif
            </div>
            <div class="user_news_div">
            <div class="user_news_name">
                <p>Регион</p>
            </div>
            
                @if(isset($news_region[0]))
                <div class="user_news_admin_list">
                @foreach($news_region as $news_item)
                    <div class="news_item_div">
                    <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')">
                    <img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="298px" height="140px">
                    </a>
                    <h2>{{ $news_item->title }}</h2>
                    <p>{{ $news_item->text }}</p>
                    <button class="delete_object" onclick="deleteNews('{{ $news_item->id }}')">Удалить новость</button>
                    </div>
                @endforeach
                </div>
                @else
                <h1 class="no_object">Нет новостей</h1>
                @endif
            </div>
            <div class="user_news_div">
            <div class="user_news_name">
                <p>Культура</p>
            </div>
            
                @if(isset($news_culture[0]))
                <div class="user_news_admin_list">
                @foreach($news_culture as $news_item)
                    <div class="news_item_div">
                    <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')">
                    <img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="298px" height="140px">
                    </a>
                    <h2>{{ $news_item->title }}</h2>
                    <p>{{ $news_item->text }}</p>
                    <button class="delete_object" onclick="deleteNews('{{ $news_item->id }}')">Удалить новость</button>
                    </div>
                @endforeach
                </div>
                @else
                <h1 class="no_object">Нет новостей</h1>
                @endif
            </div>
            <div class="user_news_div">
            <div class="user_news_name">
                <p>Проекты</p>
            </div>
                @if(isset($news_project[0]))
                <div class="user_news_admin_list">
                @foreach($news_project as $news_item)
                    <div class="news_item_div">
                    <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')">
                    <img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="298px" height="140px">
                    </a>
                    <h2>{{ $news_item->title }}</h2>
                    <p>{{ $news_item->text }}</p>
                    <button class="delete_object" onclick="deleteNews('{{ $news_item->id }}')">Удалить новость</button>
                    </div>
                @endforeach
                </div>
                @else
                <h1 class="no_object">Нет новостей</h1>
                @endif
            </div>
        </div>
        @include('components.footer')
        <script>
        function deleteNews(news_id) {
            $.ajax({
                    url: '{{ route("deleteNews") }}',
                    method: 'GET',
                    data: {
                        news_id: news_id
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getId(news_id) {
            $.ajax({
                    url: '{{ route("getId") }}',
                    method: 'GET',
                    data: {
                        news_id: news_id
                    }
                })
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }
    </script>
    </div>
</body>
</html>