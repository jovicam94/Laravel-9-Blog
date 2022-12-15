@extends('layouts.app')
@section('content')

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input name="name" value="{{ old('name') }}" type="text" required
                   class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}">
            <x-error name="name" />
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input name="email" value="{{ old('email') }}" type="text" required
                   class="form-control{{ $errors->has('email') ? ' is-invalid': '' }}">
            <x-error name="email" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" required
                   class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}">
            <x-error name="password" />
        </div>
        <div class="form-group">
            <label>Retyped Password</label>
            <input name="password_confirmation" type="password" required class="form-control">
        </div>

        <button class="btn btn-primary btn-block">Register</button>

    </form>

@endsection
