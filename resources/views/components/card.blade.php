<div class="card" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">
            {{ $subtitle }}
        </h6>
    </div>
    <ul class="list-group list-group-flush">
        @foreach($items as $item)
            <li class="list-group-item">
                @if($title == "Most commented")
                    <a class="text-decoration-none" href="{{ route('posts.show', ['post' => $item->id]) }}">{{ $item->title }}</a>
                @else
                    {{ $item->name }}
                @endif
            </li>
        @endforeach
    </ul>
</div>
