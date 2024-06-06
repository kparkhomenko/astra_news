@if(isset($news_sport[0]))
@foreach($news_sport as $news_item)
<div class="news_item_div" id="{{ $news_item->status }}">
<a href="{{ url('news/'.$news_item->id) }}" onclick="getId('{{ $news_item->id }}')">
<img src="{{ asset('storage/NewsImg/'.$news_item->img) }}" alt="" width="298px" height="140px">
</a>
<h2>{{ $news_item->title }}</h2>
<p>{{ $news_item->text }}</p>
<button class="add_object" onclick="addModerateNews('{{ $news_item->id }}')">Опубликовать новость</button>   
<button class="delete_object" onclick="deleteModerateNews('{{ $news_item->id }}')">Удалить новость</button>
</div>
@endforeach
@else 
<h1 class="no_object_moderate">Нет новостей на модерацию</h1>
@endif