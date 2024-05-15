<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kotta+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/headerStyle.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>

<div class="navbar">
    @if(Auth::check())
    <div class="logo_div">
        <a href="{{ route('mainpage') }}" class="logo_img"><img src="{{ asset('storage/img/logo.png') }}" alt=""></a>
        <p class="logo_text">Astranews</p>
    </div>
    <a href="#search_input" class="search_loup"><img src="{{ asset('storage/img/loup.png') }}" alt=""></a>

        <form action="search" method="post">
    @csrf
    <input type="text" id="search_input" name="text">
    </form><div class="navbar_links_div" id="navbar_links_div">
        <a href="{{ route('sport') }}">Спорт</a>
        <a href="{{ route('region') }}">Регион</a>
        <a href="{{ route('culture') }}">Культура</a>
        <a href="{{ route('project') }}">Проекты</a>
    </div>
    <div class="navbar_icon_div" id="navbar_icon_div">
    <a href="{{ url('userpage/' . Auth::user()->id) }}"><img src="{{ asset('storage/img/user.png') }}" alt=""></a>
    <a href="{{ route('logout') }}" class="logout_icon"><img src="{{ asset('storage/img/logout.png') }}" alt=""></a>
    </div>
    @else
    <div class="logo_div">
        <a href="{{ route('mainpage') }}" class="logo_img"><img src="{{ asset('storage/img/logo.png') }}" alt=""></a>
        <p class="logo_text">Astranews</p>
    </div>
    <a href="#search_input" class="search_loup" onkeydown="checkForEnter(event)"><img src="{{ asset('storage/img/loup.png') }}" alt=""></a>
    <form action="search" method="post">
    @csrf
    <input type="text" id="search_input" name="text">
    </form>
    <div class="navbar_links_div" id="navbar_links_div">
    <a href="{{ route('sport') }}">Спорт</a>
    <a href="{{ route('region') }}">Регион</a>
    <a href="{{ route('culture') }}">Культура</a>
    <a href="{{ route('project') }}">Проекты</a>
    </div>
    <div class="navbar_icon_div" id="navbar_icon_div">
        <a href="{{ route('login') }}"><img src="{{ asset('storage/img/login.png') }}" alt="" class="login_img"></a>
        <a href="{{ route('register') }}"><img src="{{ asset('storage/img/register.png') }}" alt="" class="register_img"></a>
    </div>
    @endif

</div>

<script>
let openSearch = document.querySelector('a[href="#search_input"]');
let searchInput = document.querySelector('#search_input');
let navbarIconDiv = document.querySelector('#navbar_icon_div');
let navbarLinksDiv = document.querySelector('#navbar_links_div');

openSearch.addEventListener('click', () => {
  if (searchInput.style.display == "none") {
     searchInput.style.display = "block";
     navbarLinksDiv.style.left = "130px";
     navbarIconDiv.style.left = "260px";
} else {
     searchInput.style.display = "none";
     navbarLinksDiv.style.left = "370px";
     navbarIconDiv.style.left = "500px";
}
});
</script>