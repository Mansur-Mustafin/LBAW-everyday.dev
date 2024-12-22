<!DOCTYPE html>
<html>

<head>
   @vite('resources/css/app.css')
   <title>Page Not Found</title>
</head>

<body class="bg-background flex flex-col items-center justify-center h-screen">
   <h1 class="text-white text-xl">404 - Page not found</h1>
   <h1 class="text-gray-500 text-sm">meow..</h1>

   @include('partials.svg.errors.404')

   <button onclick="window.history.back()" class="bg-white text-black rounded-xl px-6 py-2 font-bold">Go
      back</button>
</body>

</html>