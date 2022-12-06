@extends('layouts.app')

@section('title', $post->title)

@section('content')
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

    <p>Currently read by {{ $counter }} people</p>

    <h4>Comments</h4>
    @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}
        </p>
        <x-updated :date="$comment->created_at"/>
    @empty
        <p>No comments yet!</p>
    @endforelse
@endsection
