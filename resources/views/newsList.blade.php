<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category_name }}</title>
    <link href="{{ asset('css/newsListStyle.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    @include('components.header')
    <div class="content_container">
        <div class="category_name">
            <p>{{$category_name }}</p>
        </div>
        <div class="news_list">
        @foreach($news as $news_item) 
            <div class="news_item_div">
                <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt=""></a>
                <h1>{{ $news_item->title }}</h1>
                <p>{{ $news_item->text }}</p>
            </div> 
        @endforeach
        </div>
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