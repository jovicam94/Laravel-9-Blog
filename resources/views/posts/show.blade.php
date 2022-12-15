@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
        <h1>
            {{ $post->title }}
            @php
                now()->diffInMinutes($post->created_at) < 60 ? $show=1 : $show=0;
            @endphp

            <x-badge type="success" :show="$show" />

        </h1>
        <p>{{ $post->content }}</p>
        <x-updated :date="$post->created_at" :name="$post->user->name"/>
        <x-updated :date="$post->updated_at" type="Updated "/>

        <x-tags :tags="$post->tags" />

        <p>Currently read by {{ $counter }} people</p>

        <h4>Comments</h4>

    @include('comments._form')

    @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}
        </p>
        <x-updated :date="$comment->created_at" :name="$comment->user->name"/>
    @empty
        <p>No comments yet!</p>
    @endforelse
        </div>
    @include('posts.partials.activity')
    </div>
@endsection
