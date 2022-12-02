<p class="text-muted">
    {{ $type ?? "Added " }} {{ $date->diffForHumans() }}
    @if(isset($name))
        by {{ $name }}
    @endif
</p>
