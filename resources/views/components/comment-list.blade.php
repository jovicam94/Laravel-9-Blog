@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <x-updated :date="$comment->created_at" :name="$comment->user->name" :user="$comment->user->id" />
    <x-tags :tags="$comment->tags" />
@empty
    <p>No comments yet!</p>
@endforelse