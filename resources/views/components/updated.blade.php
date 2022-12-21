<p class="text-muted">
    {{ $type ?? "Added " }} {{ $date->diffForHumans() }}
    @if(isset($name))
        @if(isset($user))
            by <a class="text-decoration-none" href="{{ route('users.show', ['user' => $user]) }}">{{ $name }}</a>
        @else
            by {{ $name }}
        @endif
    @endif
</p>
