@extends('layouts.app')
@section('content')

    <form method="POST" action="{{ route('login') }}">
        @csrf
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
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember"
                value="{{ old('remember') ? 'checked': '' }}">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
        </div>

        <button class="btn btn-primary btn-block">Login</button>

    </form>

@endsection
