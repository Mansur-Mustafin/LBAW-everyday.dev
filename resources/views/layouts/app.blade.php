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

    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ url('js/app.js') }} defer>
    </script>
</head>

<body class="bg-black text-white">
    <main>
        <header class="p-10">

            <div>
                <h1 class="text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
                @if (!Auth::check())
                    <a class="button" href="{{ route('login') }}">Login</a>
                    <a class="button" href="{{ route('register') }}">Register</a>
                @endif
            </div>

            @if (Auth::check())
                <a class="button" href="{{ url('/logout') }}"> Logout </a>
                <a class="button" href="{{ url('/me') }}"> {{ Auth::user()->username }} </a>
            @endif
        </header>
        <section id="content">
            @yield('content')
        </section>
    </main>
</body>

</html>