@if(isset($comments_admin[0]))
@foreach($comments_admin as $comment)
    <div class="user_comment_item">
        <div class="user_comment_text_div">
            {{ $comment->text }}
        </div>
        <p class="user_comment_name">{{ $comment->user_name }}</p>
        <p class="answer">Ответ к новости</p>
        <h2>{{ $comment->title }}</h2>
        <button class="add_object" onclick="addModerateComment('{{ $comment->id }}')">Опубликовать комментарий</button>
        <button class="delete_object" onclick="deleteComment('{{ $comment->id }}')">Удалить комментарий</button>
    </div>
@endforeach
@else 
<h1 class="no_object_comment">Нет комментариев на модерацию</h1>
@endif  

