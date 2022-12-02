@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
{{--@each('posts.partials.post', $posts, 'post')--}}
<div class="row">
    <div class="col-8">
@forelse($posts as $key => $post)
    @include('posts.partials.post')
@empty
    No blog posts yet!
@endforelse
    </div>
    <div class="col-4">
        <div class="container">
            <div class="row">
            <x-card title="Most commented" subtitle="What people are currently talking about"
                    :items="$most_commented->pluck('title')"/>
            </div>
            <div class="row mt-4">
                <x-card title="Most Active" subtitle="Users with most posts written"
                        :items="$most_active->pluck('name')"/>
            </div>
            <div class="row mt-4">
                <x-card title="Most Active Last Month" subtitle="Users with most posts written in the last month"
                        :items="$most_active_last_month->pluck('name')"/>
            </div>
        </div>
    </div>
</div>

@endsection
