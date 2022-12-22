@extends('layouts.app')

@section('title', 'User profile')

@section('content')

    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ? $user->image->url() : Storage::url('/avatars/no_picture_user.png') }}" class="img-thumbnail avatar">
        </div>
        <div class="col-8">
            <h3>{{ $user->name }}</h3>

            <x-comment-form :route="route('users.comments.store', ['user' => $user->id])"/>

            <x-comment-list  :comments="$user->comments_on" />

        </div>
    </div>

@endsection
