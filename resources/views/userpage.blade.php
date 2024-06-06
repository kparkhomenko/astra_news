<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link href="{{ asset('css/userpageStyle.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>
    @include('components.header')
    <div class="container">
        <div class="user_statistics_div">
            <h1>Статистика пользователя</h1>
            <img src="{{ asset('storage/img/user.png') }}" alt="">
            <p class="host_name">{{ $user->name }}</p>
            @if($user->status == 'admin')
            <p class="admin_status">Администратор<p>
            @endif
        </div>
        <div class="user_statistics_div_list">
            <div class="user_statistics_item">
                <p class="title">Просмотрено новостей</p>
                <p class="num_value">{{ $views_count }}</p>
            </div>
            <div class="user_statistics_item">
                <p class="title">Новостей создано</p>
                <p class="num_value">{{ $news_count }}</p>
            </div>
            <div class="user_statistics_item">
                <p class="title">Оставлено комментариев</p>
                <p class="num_value">{{ $comment_count }}</p>
            </div>
            <div class="user_statistics_item">
                <p class="title">Электронная почта</p>
                <p class="text_value">{{ $user->email }}</p>
            </div>
            <div class="user_statistics_item">
                <p class="title">Район проживания</p>
                <p class="text_value">{{ $user->district }}</p>
            </div>
            <div class="user_statistics_item">
                <p class="title">Дата регистрации</p>
                <p class="text_value">{{ \Carbon\Carbon::parse($user->created_at)->format('d.m.y') }}</p>
            </div>
        </div>
        
        @if ($user->id == Auth::user()->id)
        @if (Auth::user()->status == 'admin')
        <div class="user_btns_div">
        <a href="{{ route('admin_news') }}"><button class="user_btn">Список новостей</button></a>        
        <a href="{{ route('upload') }}"><button class="user_btn">Добавить новость</button></a> 
        </div>
        @else
        <div class="user_btns_div">
        <a href="{{ route('update') }}"><button class="user_btn">Изменить информацию</button></a>        
        <a href="{{ route('upload') }}"><button class="user_btn">Предложить новость</button></a> 
        </div>
        @endif
        @endif
        @if (Auth::user()->status == 'admin')
        @if ($user->id == Auth::user()->id)
        <div class="user_news_admin_div">
            <div class="user_news_div">
            <div class="user_news_name">
                <p>Спорт</p>
            </div>
            <div class="user_news_admin_list" id="sport-news">
            </div>
            </div>
            <div class="user_news_div">
            <div class="user_news_name">
                <p>Регион</p>
            </div>
                <div class="user_news_admin_list" id="region-news">
                </div>
            </div>
            <div class="user_news_div">
            <div class="user_news_name">
                <p>Культура</p>
            </div>
                <div class="user_news_admin_list" id="culture-news">
                </div>
            </div>
            <div class="user_news_div">
            <div class="user_news_name">
                <p>Проекты</p>
            </div>
                <div class="user_news_admin_list" id="project-news">
                </div>
            </div>
        </div>
        @endif
        @else
        <div class="user_news_div">
            <div class="user_news_name">
                @if ($user->id == Auth::user()->id)
                <p>Ваши новости</p>
                @else 
                <p>Новости</p>
                @endif   
            </div>
                @if(isset($news[0]))
                <div class="user_news_list">
                @foreach($news as $news_item)
                    <div class="news_item_div">
                    <a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')">
                    <img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="298px" height="140px">
                    </a>
                    <h2>{{ $news_item->title }}</h2>
                    <p>{{ $news_item->text }}</p>
                    </div>
                @endforeach
                </div>
                @else
                <h1 class="no_object">Нет новостей</h1>
                @endif
        </div>
        @endif
        @if (Auth::user()->status == 'admin')
        @if ($user->id == Auth::user()->id)
        <div class="user_comments_admin_div">
        <div class="user_comments_div">
            <div class="user_comments_name">
                <p>Комментарии</p>
            </div>
                
                <div class="user_comments_list" id="comments">
                </div>          
        </div>            
        </div>
        @endif
        @else
        <div class="user_comments_div">
            <div class="user_comments_name">
                <p>Комментарии</p>
            </div>
               @if(isset($comments[0]))
               <div class="user_comments_list">
                @foreach($comments as $comment)
                    <div class="user_comment_item">
                        <div class="user_comment_text_div">
                            {{ $comment->text }}
                        </div>
                        <p class="answer">Ответ к новости</p>
                        <h2>{{ $comment->title }}</h2>
                    </div>
                @endforeach
                </div>
                @else 
                <h1 class="no_object">Нет комментариев</h1>
                @endif            
        </div>
        @endif
    </div>
    @include('components.footer')
    <script>
        $(document).ready(function () {
            getModerateComments();
            getModerateSportNews();
            getModerateRegionNews();
            getModerateCultureNews();
            getModerateProjectNews();
        });

        function getModerateSportNews() {
            let news = 'news';
            $.ajax({
                    url: '{{ route("getModerateSportNews") }}',
                    method: 'GET',
                    data: {
                        news: news
                    },
                    success: function(data) {
                        $('#sport-news').html(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getModerateRegionNews() {
            let news = 'news';
            $.ajax({
                    url: '{{ route("getModerateRegionNews") }}',
                    method: 'GET',
                    data: {
                        news: news
                    },
                    success: function(data) {
                        $('#region-news').html(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getModerateCultureNews() {
            let news = 'news';
            $.ajax({
                    url: '{{ route("getModerateCultureNews") }}',
                    method: 'GET',
                    data: {
                        news: news
                    },
                    success: function(data) {
                        $('#culture-news').html(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getModerateProjectNews() {
            let news = 'news';
            $.ajax({
                    url: '{{ route("getModerateProjectNews") }}',
                    method: 'GET',
                    data: {
                        news: news
                    },
                    success: function(data) {
                        $('#project-news').html(data);
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

        function deleteComment(comment_id) {
            $.ajax({
                    url: '{{ route("deleteComment") }}',
                    method: 'GET',
                    data: {
                        comment_id: comment_id
                    },
                    success: function(data) {
                        getModerateComments();
                        console.log(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getModerateComments() {
            let comments = 'comments';
            $.ajax({
                    url: '{{ route("getModerateComments") }}',
                    method: 'GET',
                    data: {
                        comments: comments
                    },
                    success: function(data) {
                        $('#comments').html(data);
                        console.log(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function addModerateComment(comment_id) {
            $.ajax({
                    url: '{{ route("addModerateComment") }}',
                    method: 'GET',
                    data: {
                        comment_id: comment_id
                    },
                    success: function(data) {
                        getModerateComments();
                        console.log(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function deleteModerateNews(news_id) {
            $.ajax({
                    url: '{{ route("deleteModerateNews") }}',
                    method: 'GET',
                    data: {
                        news_id: news_id
                    }, 
                    success: function(data) {
                        getModerateSportNews();
                        getModerateRegionNews();
                        getModerateCultureNews();
                        getModerateProjectNews();
                    }
                })
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function addModerateNews(news_id) {
            $.ajax({
                    url: '{{ route("addModerateNews") }}',
                    method: 'GET',
                    data: {
                        news_id: news_id
                    },
                    success: function(data) {
                        getModerateSportNews();
                        getModerateRegionNews();
                        getModerateCultureNews();
                        getModerateProjectNews();
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }
        let moderated = document.querySelector('#moderated');
        console.log(moderated);
    </script>
</body>
</html>