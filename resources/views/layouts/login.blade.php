<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=visibility" />

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/auth.js')

    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
</head>


<body class="bg-[url('/public/assets/backg.svg')] bg-cover text-white">
    <main class="flex flex-col h-screen">
        <div class="flex flex-grow">
            <div class="py-3 px-5">
                <h1 class="text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
                @if (!Auth::check())
                    <a class="button" href="{{ route('login') }}">Login</a>
                    <a class="button" href="{{ route('register') }}">Register</a>
                @endif
            </div>
            <section id="content" class="flex items-center justify-center w-full h-full">
                @yield('content')
            </section>
        </div>
    </main>
</body>
</html>