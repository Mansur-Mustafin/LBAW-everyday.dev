@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">{{ $title }}</h1>
        <div data-last_page="{{ $news_posts->lastPage() }}" data-url="{{ $baseUrl }}" id="news-posts-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($news_posts as $news)
                @include('partials.tile-post', ['news' => $news])
            @endforeach
        </div>
    </div>
@endsection
