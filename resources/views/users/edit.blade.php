@extends('layouts.app')

@section('title', 'User profile')

@section('content')
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-4">
                <img src="{{ $user->image ? $user->image->url() : Storage::url('/avatars/no_picture_user.png' }}"
                     class="img-thumbnail avatar">
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input type="file" class="form-control-file" name="avatar">
                    </div>
                    <x-error name="avatar"/>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    <x-error name="name"/>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </div>
        </div>
    </form>
@endsection
