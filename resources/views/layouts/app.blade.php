<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
</head>

<body class="bg-background text-white">
    <main class="flex flex-col h-screen">
        <header class="py-3 px-5 flex justify-between items-center border-b border-1 border-gray-700">
            <div>
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
            </div>

            @if (Auth::check())
                <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ route('create') }}">
                    New post
                </a>
            @endif
        </header>
        <div class="flex flex-grow">
            <section class="border-r border-solid border-gray-700 w-64">
                <div>
                </div>
            </section>
            <section id="content" class="w-full h-full">
                @yield('content')
            </section>
        </div>
    </main>
</body>

</html>