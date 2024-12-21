@extends('layouts.app')

@section('body')

<body class="bg-background text-white h-screen">
    <main class="flex flex-col h-full">
        @include('layouts.header')
        @include('partials.notification-container')

        <div class="flex flex-grow">

            @include('layouts.aside')

            <section id="content" class="mt-20 w-full h-full">
                @yield('content')
            </section>
        </div>
    </main>
</body>
@endsection