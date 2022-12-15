<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel app - @yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/app.scss') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{--    @vite(['resources/css/app.css','resources/js/app.js'])--}}

</head>
<body style="min-height: 100vh">
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm mb-3">
    <h5 class="my-0 mr-md-auto font-weight-normal text-muted">Laravel App</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark text-decoration-none" href="{{ route('home.index') }}">Home</a>
        <a class="p-2 text-dark text-decoration-none" href="{{ route('contact') }}">Contact</a>
        <a class="p-2 text-dark text-decoration-none" href="{{ route('posts.index') }}">Blog Posts</a>
        <a class="p-2 text-dark text-decoration-none" href="{{ route('posts.create') }}">Add Blog Post</a>

        @guest
            @if(Route::has('register'))
                <a href="{{ route('register') }}" class="p-2 text-dark">Register</a>
            @endif
            <a href="{{ route('login') }}" class="p-2 text-dark">Login</a>
        @else
            <a href="{{ route('logout') }}
            "onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            class="p-2 text-dark">Logout ({{ Auth::user()->name }})</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
    </nav>
</div>
<div class="container">
    <script>
        toastr.options =
            {
                "closeButton" : true,
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "progressBar" : true
            }
    @if(session('create'))
        toastr.success("{{ session('create') }}");
    @elseif(session('update'))
        toastr.info("{{ session('update') }}");
    @elseif(session('delete'))
        toastr.error("{{ session('delete') }}")
    @endif



    </script>

        @yield('content')
</div>
<footer class="sticky-footer bg-white border-top shadow-lg" style="position: sticky; top:100%;">
    <div class="footer-copyright text-center">© Copyright 2022.
        <a class="text-decoration-none" href="https://rs.linkedin.com/in/jovica-misirlic"> Coding by Jovica Misirlić.</a>
    </div>
    <div class="text-center py-3">
        All rights reserved.
    </div>
</footer>
</body>
</html>
