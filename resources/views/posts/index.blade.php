@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
{{--@each('posts.partials.post', $posts, 'post')--}}
<div class="row">
    <div class="col-8">
@forelse($posts as $post)
    @include('posts.partials.post')
@empty
    No blog posts yet!
@endforelse
    </div>
    @include('posts.partials.activity')
</div>

@endsection
