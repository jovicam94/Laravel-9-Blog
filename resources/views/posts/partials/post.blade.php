@if($post->trashed())
    <del>
@endif
<h3>
    <a class="text-decoration-none {{ $post->trashed() ? 'text-muted' : '' }}" href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
</h3>

@if($post->trashed())
    </del>
@endif

<x-updated :date="$post->created_at" :name="$post->user->name" :user="$post->user->id"/>

<x-tags :tags="$post->tags" />


@if($post->comments_count)
    <p>{{ $post->comments_count }} comments</p>
@else
    <p>No comments yet!</p>
@endif

<div class="mb-3">
    @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
    @endcan
{{--    @cannot('delete', $post)--}}
{{--        <p>You can't delete this post</p>--}}
{{--    @endcannot--}}
    @auth
        @if(!$post->trashed())
            @can('delete', $post)
                <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}", method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete!" class="btn btn-primary">
                </form>
            @endcan
        @endif
    @endauth
</div>
