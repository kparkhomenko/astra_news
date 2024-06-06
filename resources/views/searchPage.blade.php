<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск</title>
    <link href="{{ asset('css/searchPageStyle.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>
    @include('components.header')
    <div class="container">
    <div class="content_container">
    @if(isset($news_search[0]))
    <div class="news_list_div">
        @foreach($news_search as $news_item)
        <div class="news_item_div">
        <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt=""></a>
        <h1>{{ $news_item->title }}</h1>
        <p>{{ $news_item->text }}</p>
        </div>
        @endforeach
    </div>
    @else
    <h1 class="no_results">По вашему запросу ничего не найдено</h1>
    @endif
    </div>
    </div>
    @include('components.footer')
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