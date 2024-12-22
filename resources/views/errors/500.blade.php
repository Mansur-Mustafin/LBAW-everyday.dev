<!DOCTYPE html>
<html>

<head>
   @vite('resources/css/app.css')
   <title>Error</title>
</head>

<body class="bg-background flex flex-col items-center justify-center h-screen">
   <h1 class="text-white text-xl">500 - Error</h1>
   <h1 class="text-gray-500 text-sm">Oops!</h1>

   @include('partials.svg.errors.500')

   <button onclick="window.history.back()" class="bg-white text-black rounded-xl px-6 py-2 font-bold mt-24">Go
      back</button>
</body>

</html>