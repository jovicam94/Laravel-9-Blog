@extends('layouts.app')

@section('title', 'Contact page')

@section('content')
    <h1>Contact</h1>
    <p>Hello this is contact!</p>

    @can('home.secret')
        <a href="{{ route('secret') }}">
        <p>Special contact details!</p>
        </a>
    @endcan
@endsection
