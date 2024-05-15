<head>
    <link href="{{ asset('css/commentsStyle.css') }}" rel="stylesheet">  
</head>

@if(isset($comments[0]))
@foreach($comments as $comment)
<div class="comment_item_div">
    <div class="upper">
    <p class="comment_name">{{ $comment->user_name }}</p>
    <p class="comment_date">{{ \Carbon\Carbon::parse($comment->created_at)->format('H:m d.m.y')}}</p>
    </div>
    <div class="comment_text_div">
        <p>{{ $comment->text }}</p>
    </div>
</div>
@endforeach
@else
<h2>Будьте первым, кто оставит комментарий</h2>
@endif
