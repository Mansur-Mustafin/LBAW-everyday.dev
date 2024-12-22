<!DOCTYPE html>
<html>

<head>
    @vite('resources/css/app.css')
    <title>Invalid Link</title>
</head>

<body class="bg-background flex flex-col items-center justify-center h-screen">
    <h1 class="text-white text-xl">The link is invalid or has expired.</h1>
    <h1 class="text-gray-500 text-sm">Please request a new one.</h1>

    @include('partials.svg.errors.invalid-link')

    <a href="{{ route('login') }}" class="bg-white text-black rounded-xl px-6 py-2 font-bold mt-24">Go to login</a>
</body>

</html>