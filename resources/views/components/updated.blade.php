<p class="text-muted">
    @if($type == "Updated ")
        {{ __('Updated') }} {{ $date->diffForHumans() }}
    @else
        {{ __('Added') }} {{ $date->diffForHumans() }}
    @endif
    @if(isset($name))
        @if(isset($user))
            {{ __('by') }} <a class="text-decoration-none" href="{{ route('users.show', ['user' => $user]) }}">{{ $name }}</a>
        @else
            {{ __('by') }} {{ $name }}
        @endif
    @endif
</p>
