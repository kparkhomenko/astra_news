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
    @include('components.header')
    <div class="container">
        <div class="content_div">
            <div class="news_item_div">
                <h1>{{ $news_item->title }}</h1>
                <p class="news_item_date">
                    Опубликовано в 
                    {{ \Carbon\Carbon::parse($news_item->created_at)->format('H:i') }},
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
                <div id="error_container"></div>       
                <button onclick="getComment('{{ $news_item->id }}')" id="comment_btn">Добавить комментарий</button>
                @if (Auth::user()->status == 'user')
                <div id="success_container"></div>                    
                @endif
                @endif
            </div>
            <h1 class="comments_div_title">Комментарии к новости</h1>
            <input type="hidden" value="{{$news_item->id}}" id="news_id_input">
            <div class="comments_view_div" id="comments">

            </div>
            </div>
            <div class="last_news_list">
                    <div class="list_line"></div>
                    <h1>Лента новостей</h1>
                    <div class="last_news_item_div">
                    @foreach($last_news as $news_item)
                        <div class="last_news_item">
                            <p class="date">{{ \Carbon\Carbon::parse($news_item->created_at)->format('H:i') }}</p>
                            <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')"><p class="last_news_item_text">{{ $news_item->text }}</p></a>
                        </div>
                    @endforeach
                    </div>
            </div>
        </div>
    </div>
    @include('components.footer')
<script>
        $(document).ready(function () {
            getComments();
        });
        function getComments() {
            let comments = 'comments';
            let news_id = document.getElementById("news_id_input").getAttribute("value");
            $.ajax({
                    url: '{{ route("getComments") }}',
                    method: 'GET',
                    data: {
                        comments: comments,
                        news_id: news_id
                    },
                    success: function(data) {
                        $('#comments').html(data);
                        console.log(news_id);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function sendComment(text, news_id) {
            $.ajax({
                    url: '{{ route("sendComment") }}',
                    method: 'GET',
                    data: {
                        text: text,
                        news_id: news_id
                    },
                    success: function(data) {
                        $('#success_container').empty();
                        let success = '<p id="comment_success" class="success">Комментарий отправлен на модерацию<p>'
                        $('#success_container').append(success);
                        $('textarea').val('');
                        console.log(data);
                        getComments();
                    }
                })
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getComment(news_id) {
            let text = $('#comment').val();
            if (text.length > 400) {
                $('#error_container').empty();
                let p = '<p id="comment_error" class="error">Лимит символов превышен. Максимум 400<p>'
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