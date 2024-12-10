@extends('layouts.body.default')

@section('content')
    @include('partials.success-popup')

    <div class="container tablet:mx-auto w-full">
        <div class="flex flex-row items-center px-5 pt-5">
            <h1 class="text-2xl font-semibold grow">{{ $title }}</h1>
            <div class="relative" id="sort-by-container">
                <button id="toggle-sort-button"
                    class="flex flex-row items-center mr-2 cursor-pointer hover:bg-input transition rounded-md px-2 py-1">
                    <p class="text-sm mr-1 font-semibold"></p>
                    <svg class="transition ease-out rotate-180" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-up"><path d="m18 15-6-6-6 6"/></svg>
                </button>
                @include('partials.sort-by')
            </div>
            
            <div class="relative">
                <button id="toggle-filter-button" class="mr-5 hover:bg-input rounded-md py-1 px-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ellipsis-vertical"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
                </button>
                @include('partials.filter')
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
