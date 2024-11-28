@extends('layouts.app')

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

    <div id="loading-icon">
        <div class="grid grid-cols-1 tablet:grid-cols-2 laptop:grid-cols-3 desktop:grid-cols-4 gap-4">
            @include('partials.load-tile-post')
            @include('partials.load-tile-post')
            @include('partials.load-tile-post')
            @include('partials.load-tile-post')
            @include('partials.load-tile-post')
            @include('partials.load-tile-post')
            @include('partials.load-tile-post')
            @include('partials.load-tile-post')
        </div>
        <img class="w-20 h-20 mx-auto" src="{{url('/assets/loading-icon.gif')}}" alt="Loading..."> 
    </div>
    <style>
        /* 1 col */
        @media (max-width: 640px) {
            #loading-icon .loading-box:nth-child(n + 3) {
                display: none;
                padding: 10em;
            }
        }
        /* 2 col */
        @media (max-width: 1024px) {
            #loading-icon .loading-box:nth-child(n + 5) {
                display: none;
                padding: 10em;
            }
        }
        /* 3 col */
        @media (max-width: 1280px) {
            #loading-icon .loading-box:nth-child(n + 7) {
                display: none;
                padding: 10em;
            }
        }
        /* 4 col: show all */
    </style>

</div>
@endsection