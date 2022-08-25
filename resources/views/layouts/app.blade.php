<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel app - @yield('title')</title>
    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    @vite(['resources/js/app.js'])

</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm mb-3">
    <h5 class="my-0 mr-md-auto font-weight-normal text-muted">Laravel App</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark text-decoration-none" href="{{ route('home.index') }}">Home</a>
        <a class="p-2 text-dark text-decoration-none" href="{{ route('home.contact') }}">Contact</a>
        <a class="p-2 text-dark text-decoration-none" href="{{ route('posts.index') }}">Blog Posts</a>
        <a class="p-2 text-dark text-decoration-none" href="{{ route('posts.create') }}">Add Blog Post</a>
    </nav>
</div>
<div class="container">
@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

        @yield('content')
</div>
</body>
</html>
