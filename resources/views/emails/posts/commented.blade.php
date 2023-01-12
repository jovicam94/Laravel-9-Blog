<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<div>
    <p>Hi {{ $comment->commentable->user->name }}</p>
    <p class="div-mail">
        Someone has commented on your blog post
        <a href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">
            {{ $comment->commentable->title }}
        </a>
    </p>
    <hr />

    <p>
{{--        <img src="{{ $message->embed($comment->user->image->url()) }}" alt="profile_pic">--}}
        <img src="{{ $comment->user->image->url() }}" alt="profile_pic">
        <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">
            {{ $comment->user->name }}
        </a> said:
    </p>

    <p>
        "{{ $comment->content }}"
    </p>
</div>
