@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <x-updated :date="$comment->created_at" :name="$comment->user->name" :user="$comment->user->id" />
    <x-tags :tags="$comment->tags" />
@empty
    {{ trans_choice('messages.comments', 0) }}
@endforelse
