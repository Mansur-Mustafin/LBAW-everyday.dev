@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Recent News</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($newsPosts as $news)
                @include('partials.tile-post', ['news' => $news])
            @endforeach
        </div>
    </div>
@endsection
