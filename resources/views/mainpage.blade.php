<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link href="{{ asset('css/mainpageStyle.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        @include('components.header')
        @if(isset($news_sport[0]))
        <div class="category_1_container">
            <div class="category_1_div">
            <div class="category_1_name">
                <p>Спорт</p>
            </div>
            @foreach($news_sport as $news_item)
            @if ($loop->first)
            <div class="first_item">
                <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="722px" height="247px"></a>
                <h1>{{ $news_item->title }}</h1>
                <p>{{ $news_item->text }}</p>
            </div>
            @endif            
            @endforeach
            <div class="last_news_list">
                <div class="list_line"></div>
                <h1>Лента новостей</h1>
                @foreach($last_news as $news_item)
                    <div class="last_news_item">
                        <p class="date">{{ \Carbon\Carbon::parse($news_item->created_at)->format('H:m') }}</p>
                        <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><p class="last_news_item_text">{{ $news_item->text }}</p></a>
                    </div>
                @endforeach
            </div>
            </div>
            <div class="news_1_list">
            @foreach($news_sport as $news_item)
            @if ($loop->first)
            <div class="hidden">
            </div>
            @else 
            <div class="news_item_1_div">
                <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt=""></a>
                <h1>{{ $news_item->title }}</h1>
                <p>{{ $news_item->text }}</p>
            </div> 
            @endif
            @endforeach
            </div>
        </div>
        @endif
        @if(isset($news_region[0]))
        <div class="category_2_container">
        <div class="category_1_div">
            <div class="category_1_name">
                <p>Регион</p>
            </div>
            @foreach($news_region as $news_item)
            @if ($loop->first)
            <div class="first_item">
                <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="722px" height="247px"></a>
                <h1>{{ $news_item->title }}</h1>
                <p>{{ $news_item->text }}</p>
            </div>
            @endif            
            @endforeach
            </div>
            <div class="news_1_list">
            @foreach($news_region as $news_item)
            @if ($loop->first)
            <div class="hidden">
            </div>
            @else 
            <div class="news_item_1_div">
                <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt=""></a>
                <h1>{{ $news_item->title }}</h1>
                <p>{{ $news_item->text }}</p>
            </div> 
            @endif
            @endforeach
            </div>
        </div>
        @endif
        @if(isset($news_culture[0]))
        <div class="category_3_container">
            <div class="category_1_name">
                <p>Культура</p>
            </div>
            <div class="news_2_list">
            @foreach($news_culture as $news_item)
            <div class="news_item_2_div">
                <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="510px" height="247px"></a>
                <h1>{{ $news_item->title }}</h1>
                <p>{{ $news_item->text }}</p>               
            </div>
            @endforeach
            </div>
        </div>
        @endif
        @if(isset($news_project[0]))
        <div class="category_4_container">
        <div class="category_1_name">
                <p>Проекты</p>
            </div>   
        </div>
        <div class="news_3_list">
            @foreach($news_project as $news_item)
            <div class="news_item_3_div">
                <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="298px" height="140px"></a>
                <h1>{{ $news_item->title }}</h1>
                <p>{{ $news_item->text }}</p>               
            </div>
            @endforeach
        </div>
        @endif
    @include('components.footer')
    </div>
    <script>
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
</body>
</html>