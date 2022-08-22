@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div><input type="text" name="title"></div>
        @error('title')
        <div>{{ $message }}</div>
        @enderror
        <div><textarea name="content"></textarea></div>
        @error('content')
        <div>{{ $message }}</div>
        @enderror
        <div><input type="submit" value="Create"></div>

    </form>
@endsection
