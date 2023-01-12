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
    {{ trans_choice('messages.comments', $post->comments_count) }}
@else
    {{ trans_choice('messages.comments', 0) }}
@endif

<div class="mb-3">
    @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-warning">{{ __('Edit') }}</a>
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
                    <input type="submit" value="{{__('Delete!')}}" class="btn btn-danger">
                </form>
            @endcan
        @endif
    @endauth
</div>
