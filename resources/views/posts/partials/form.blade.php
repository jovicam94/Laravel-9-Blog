<div>
    <input type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
@error('title')
<div>{{ $message }}</div>
@enderror
<div>
    <textarea name="content">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
@error('content')
<div>{{ $message }}</div>
@enderror
