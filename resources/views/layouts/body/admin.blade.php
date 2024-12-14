@extends('layouts.app')

@section('body')
<body class="bg-background text-white">
    <main class="flex flex-col h-screen">
        @include('layouts.header')
        @include('partials.notification-container')

        <div class="flex flex-grow">

            @include('layouts.admin-aside')

            <section id="content" class="w-full h-full">
                @yield('content')
            </section>
        </div>
    </main>
</body>
@endsection
