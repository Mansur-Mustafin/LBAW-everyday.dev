@extends('layouts.app')

@section('body')
<body class="bg-background text-white">
    <main class="flex flex-col h-screen">
        <div class="py-3 px-5">
            <h1 class="text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
        </div>
        <section id="content" class="flex items-center justify-center w-full h-full">
            @yield('content')
        </section>
        {{-- Inlude here footer --}}
    </main>
</body>
@endsection
