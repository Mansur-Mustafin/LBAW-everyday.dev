@extends('layouts.body.default')

@section('content')
    @include('partials.success-popup')

    <div class="container tablet:mx-auto w-full">
        <h1 class="text-2xl font-semibold my-4 ml-4">{{ $title }}</h1>

        <div data-last_page="{{ $news_posts->lastPage() }}" data-url="{{ $baseUrl }}" id="news-posts-container"
            class="grid grid-cols-1 tablet:grid-cols-2 laptop:grid-cols-3 desktop:grid-cols-4 gap-4">
            @foreach ($news_posts as $news)
                @include('partials.tile-post', ['news' => $news])
            @endforeach
        </div>

        <div id="loading-icon" class="hidden">
            <div class="grid grid-cols-1 tablet:grid-cols-2 laptop:grid-cols-3 desktop:grid-cols-4 gap-4">
                <div>@include('partials.load-tile-post')</div>
                <div>@include('partials.load-tile-post')</div>
                <div class="hidden tablet:block">@include('partials.load-tile-post')</div>
                <div class="hidden tablet:block">@include('partials.load-tile-post')</div>
                <div class="hidden laptop:block">@include('partials.load-tile-post')</div>
                <div class="hidden laptop:block">@include('partials.load-tile-post')</div>
                <div class="hidden desktop:block">@include('partials.load-tile-post')</div>
                <div class="hidden desktop:block">@include('partials.load-tile-post')</div>
            </div>
            <img class="w-20 h-20 mx-auto" src="{{ url('/assets/loading-icon.gif') }}" alt="Loading...">
        </div>
    </div>
@endsection
