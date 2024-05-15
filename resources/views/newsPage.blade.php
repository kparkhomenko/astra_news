<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news_item->title }}</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="{{ asset('css/newsPageStyle.css') }}" rel="stylesheet">  
</head>
<body>
    <div class="container">
        @include('components.header')
        <div class="content_div">
            <div class="news_item_div">
                <h1>{{ $news_item->title }}</h1>
                <p class="news_item_date">
                    Опубликовано в 
                    {{ \Carbon\Carbon::parse($news_item->created_at)->format('H:m') }},
                    {{ \Carbon\Carbon::parse($news_item->created_at)->translatedFormat('j F Y г.') }}
                </p>
                <img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="828px" height="602px">
                <p class="news_item_text">{{ $news_item->text }}</p>
            <div class="comment_create_div">
                @if(Auth::check())
                <h1>Что вы думаете об этой новости?</h1>
                <div>
                <textarea id="comment" name="comment" placeholder="Ваш комментарий"></textarea>
                </div>
                <button onclick="getComment('{{ $news_item->id }}')" id="comment_btn">Добавить комментарий</button>
                <div id="error_container"></div>
                @if(session('success_message') !== null)
                    <p class="success">{{ session('success_message') }}<p>
                    <p class="success">{{ Session::forget('success_message') }}</p>
                @endif               
                @endif
            </div>
            <div class="comments_view_div">
                <h1>Комментарии к новости</h1>
                @include('components.comments')
            </div>
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
        function sendComment(text, news_id) {
            $.ajax({
                    url: '{{ route("sendComment") }}',
                    method: 'GET',
                    data: {
                        text: text,
                        news_id: news_id
                    },
                    success: function(data) {
                        $('#comments').empty().append(data);
                        $('textarea').val('');
                        console.log(data);
                    }
                })
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getComment(news_id) {
            let text = $('#comment').val();
            if (text.length > 300) {
                $('#error_container').empty();
                let p = '<p id="comment_error">Лимит символов превышен<p>'
                $('#error_container').append(p);
            } else
                $('#error_container').empty();
            sendComment(text, news_id);
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
</body>
</html>