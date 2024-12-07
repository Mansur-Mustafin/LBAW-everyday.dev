@extends('layouts.app')

@section('content')
    @include('partials.success-popup')

    <div class="container tablet:mx-auto w-full">
        <div id="follow-tag-section" class="flex gap-2">
            <h1 class="text-2xl font-semibold my-4 ml-4">{{ $title }}</h1>
            <div class="place-content-center">
            @if (isset($tag) && Auth::check() )
                <div id="follow-tag-data" class="hidden" data-url="{{url('')}}" data-tagid={{$tag->id}} data-isfollowed={{Auth::user()->tags->contains($tag) ? 'true' : 'false'}}></div>
                <button id="follow-tag-button" class="hidden justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none" 
                    >Follow</button>
                <button id="unfollow-tag-button" class="hidden justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none" 
                    >Unfollow</button>
            @endif
            </div>
        </div>

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
