@extends('layouts.body.default')

@section('title', $title)

@section('content')
@include('partials.success-popup')

<div class="container tablet:mx-auto w-full">
    <div class="flex flex-row items-center px-5 pt-5">
        <h1 id="news-page-title" class="text-2xl font-semibold grow">{{ $title }}</h1>
        @isset($tags)
            <div class="relative" id="sort-by-container">
                <button id="toggle-sort-button"
                    class="flex flex-row items-center mr-2 cursor-pointer hover:bg-input transition rounded-md px-2 py-1">
                    <p class="text-sm mr-1 font-semibold">Sort by</p>
                    @include('partials.svg.sort')
                </button>
                @include('partials.filter.sort-by')
            </div>

            <div class="relative">
                <button id="toggle-filter-button" class="mr-5 hover:bg-input rounded-md py-1 px-1">
                    @include('partials.svg.filter')
                </button>
                @include('partials.filter.filter')
            </div>
        @endisset
    </div>

    <div data-url="{{ $baseUrl }}" id="news-posts-container"
        class="grid grid-cols-1 tablet:grid-cols-2 laptop:grid-cols-3 desktop:grid-cols-4 gap-4">
    </div>

    <div id="loading-icon" class="hidden">
        <div class="grid grid-cols-1 tablet:grid-cols-2 laptop:grid-cols-3 desktop:grid-cols-4 gap-4">
            <div>@include('partials.post.load-tile-post')</div>
            <div>@include('partials.post.load-tile-post')</div>
            <div class="hidden tablet:block">@include('partials.post.load-tile-post')</div>
            <div class="hidden tablet:block">@include('partials.post.load-tile-post')</div>
            <div class="hidden laptop:block">@include('partials.post.load-tile-post')</div>
            <div class="hidden laptop:block">@include('partials.post.load-tile-post')</div>
            <div class="hidden desktop:block">@include('partials.post.load-tile-post')</div>
            <div class="hidden desktop:block">@include('partials.post.load-tile-post')</div>
        </div>
        <img class="w-20 h-20 mx-auto" src="{{ url('/assets/loading-icon.gif') }}" alt="Loading...">
    </div>

    <div id="no-results" class="hidden flex flex-col items-center justify-center">
        <h1 class="text-white text-xl">No results found.</h1>
        <h1 class="text-gray-500 text-sm">meow..</h1>

        @include('partials.svg.errors.404')
    </div>
</div>
@endsection