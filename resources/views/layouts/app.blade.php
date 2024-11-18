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
    @vite('resources/js/vote.js')
    @vite('resources/js/search.js')

    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
</head>

<body class="bg-background text-white">
    <main class="flex flex-col h-screen">
        
        @include('layouts.header')

        <div class="flex flex-grow">
            
            @include('layouts.aside')

            <section id="content" class="w-full h-full">
                @yield('content')
            </section>
        </div>

    </header>
</main>
</body>
</html>
