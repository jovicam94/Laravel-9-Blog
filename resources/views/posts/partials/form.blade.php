<div class="form-group">
    <label for="title">Title</label>
    <input id="title" type="text" name="title" class="form-control" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
<x-error name="title" />
<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" id="content" name="content">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
<x-error name="content" />
<div class="form-group">
    <label for="thumbnail">Thumbnail</label><br>
    <input type="file" name="thumbnail" class="form-control-file">
</div>
<x-error name="thumbnail" />
