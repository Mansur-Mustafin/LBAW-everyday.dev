<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/vote.js')
    @vite('resources/js/search.js')
    @vite('resources/js/infinite-page.js')
    @vite('resources/js/auth.js')
    @vite('resources/js/edit-profile.js')

    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="@yield('body-class', 'bg-background text-white')">
    <main class="flex flex-col h-screen">
        
        @if (in_array(Route::currentRouteName(), ['login', 'register']))
            <div class="py-3 px-5">
                <h1 class="text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
                <a class="button" href="{{ route('login') }}">Login</a>
                <a class="button" href="{{ route('register') }}">Register</a>
            </div>
            <section id="content" class="flex items-center justify-center w-full h-full">
                @yield('content')
            </section>
        @else
            @include('layouts.header')
            
            <div class="flex flex-grow">
                
                @include('layouts.aside')

                <section id="content" class="w-full h-full">
                    @yield('content')
                </section>
            </div>
        @endif
    </main>
</body>
</html>
