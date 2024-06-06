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
    @include('components.header')
    <div class="container">
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
        <script>
        $(document).ready(function () {
            getSportNews();
            getRegionNews();
            getCultureNews();
            getProjectNews();
        });
        function getSportNews() {
            let news = 'news';
            $.ajax({
                    url: '{{ route("getSportNews") }}',
                    method: 'GET',
                    data: {
                        news: news
                    },
                    success: function(data) {
                        $('#sport-news').html(data);
                        console.log(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getRegionNews() {
            let news = 'news';
            $.ajax({
                    url: '{{ route("getRegionNews") }}',
                    method: 'GET',
                    data: {
                        news: news
                    },
                    success: function(data) {
                        $('#region-news').html(data);
                        console.log(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getCultureNews() {
            let news = 'news';
            $.ajax({
                    url: '{{ route("getCultureNews") }}',
                    method: 'GET',
                    data: {
                        news: news
                    },
                    success: function(data) {
                        $('#culture-news').html(data);
                        console.log(data);
                    }
                }) 
                .fail(function(jqXHR, ajaxOpions, throwError) {
                    console.log(data);
                })
        }

        function getProjectNews() {
            let news = 'news';
            $.ajax({
                    url: '{{ route("getProjectNews") }}',
                    method: 'GET',
                    data: {
                        news: news
                    },
                    success: function(data) {
                        $('#project-news').html(data);
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
                        getSportNews();
                        getRegionNews();
                        getCultureNews();
                        getProjectNews();
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
    @include('components.footer')
</body>
</html>