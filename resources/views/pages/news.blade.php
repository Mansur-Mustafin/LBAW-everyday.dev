@extends('layouts.app')

@section('content')
    <div class="container tablet:mx-auto w-full">
        <h1 class="text-2xl font-semibold mb-4">{{ $title }}</h1>
        <div data-last_page="{{ $news_posts->lastPage() }}" data-url="{{ $baseUrl }}" id="news-posts-container" class="grid grid-cols-1 tablet:grid-cols-2 laptop:grid-cols-3 desktop:grid-cols-4 gap-4">
            @foreach ($news_posts as $news)
                @include('partials.tile-post', ['news' => $news])
            @endforeach
        </div>
    </div>
@endsection
