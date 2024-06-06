<head>
<link href="{{ asset('css/footerStyle.css') }}" rel="stylesheet"> 
</head>

<footer>
  <div class="footer_div">
    <div class="logo_div_2">
        <a href="{{ route('mainpage') }}" class="logo_img"><img src="{{ asset('storage/img/logo.png') }}" alt=""></a>
        <p class="logo_text">Astranews</p>
    </div>
    <p class="right_reserved">Все права защищены</p>
    <div class="soc_sites_div">
    <a href=""><img src="{{ asset('storage/img/whatsapp.png') }}" alt="" id="whatsapp"></a>
    <a href=""><img src="{{ asset('storage/img/telegram.png') }}" alt="" id="telegram"></a>
    <a href=""><img src="{{ asset('storage/img/vk.png') }}" alt="" id="vk"></a>
    </div>
  </div>
</footer>

<script>
$('#whatsapp').hover(
  function() { $(this).attr('src', '{{ asset('storage/img/whatsapp_active.png') }}'); },
  function() { $(this).attr('src', '{{ asset('storage/img/whatsapp.png') }}'); }
);

$('#telegram').hover(
  function() { $(this).attr('src', '{{ asset('storage/img/telegram_active.png') }}'); },
  function() { $(this).attr('src', '{{ asset('storage/img/telegram.png') }}'); }
);

$('#vk').hover(
  function() { $(this).attr('src', '{{ asset('storage/img/vk_active.png') }}'); },
  function() { $(this).attr('src', '{{ asset('storage/img/vk.png') }}'); }
);
</script>