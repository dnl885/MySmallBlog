<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{mix('/js/app.js')}}"></script>
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <title>My Small Blog</title>
</head>

<body>
<main role="main" class="container">
    <div class="container">
        @include('layouts.public.components.app-header')
        @include('layouts.public.components.login-signup-overlay')
    </div>
    <div class="row">
        <div class="col-md-8 blog-main">
            @yield('content')
        </div>
        @include('layouts.public.components.app-sidebar')
    </div>
</main>
@include('layouts.public.components.app-footer')
</body>

<script>
    Welcome.init();
    @yield('javascript_init')
</script>

</html>
