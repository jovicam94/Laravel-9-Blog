<div class="mb-2 mt-2">
    @auth
        <form method="POST" action="{{ $route }}">
            @csrf
            <div class="form-group">
                <textarea name="content" type="text" class="form-control" rows="3" style="resize: none;"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">{{ __('Add comment') }}</button>
            <x-error name="content"></x-error>
        </form>
    @else
        <a class="text-decoration-none" href="{{route('login')}}">{{ __('Sign-in') }}</a> {{__('to post comments!')}}
    @endauth
</div>
<hr />
