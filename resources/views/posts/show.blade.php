@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
            @if($post->image)
                <div style="background-image: url('{{ $post->image->url() }}');
             min-height: 500px; color: white; text-align: center;">
                    <h1>
            @else
                <h1>
            @endif
            {{ $post->title }}
            @php
                now()->diffInMinutes($post->created_at) < 60 ? $show=1 : $show=0;
            @endphp

            <x-badge type="success" :show="$show" />

            @if($post->image)
                    </h1>
                </div>
            @else
                </h1>
            @endif
            <p>{{ $post->content }}</p>


            <x-updated :date="$post->created_at" :name="$post->user->name" :user="$post->user->id "/>
            <x-updated :date="$post->updated_at" type="Updated " :user="$post->user->name"/>

            <x-tags :tags="$post->tags" />

            <p>Currently read by {{ $counter }} people</p>

            <h4>Comments</h4>

            <x-comment-form :route="route('posts.comments.store', ['post' => $post->id])"/>

            <x-comment-list  :comments="$post->comments" />

        </div>
    @include('posts.partials.activity')
    </div>
@endsection
