<p>
    @foreach($tags as $tag)
        <a href="{{ route('posts.tag.index', ['id' => $tag->id]) }}"
           class="badge bg-success text-decoration-none badge-lg">{{ $tag->name }}</a>
    @endforeach
</p>
