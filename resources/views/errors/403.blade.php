<!DOCTYPE html>
<html>

<head>
   @vite('resources/css/app.css')
   <title>Forbidden</title>
</head>

<body class="bg-background flex flex-col items-center justify-center h-screen">
   <h1 class="text-white text-xl">403 - Forbidden</h1>
   <h1 class="text-gray-500 text-sm">Get out of here!</h1>

   @include('partials.svg.errors.403')

   <button onclick="window.history.back()" class="bg-white text-black rounded-xl px-6 py-2 font-bold mt-24">Go
      back</button>
</body>

</html>