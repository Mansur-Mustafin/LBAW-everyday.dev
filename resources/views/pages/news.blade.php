@extends('layouts.body.default')

@section('title',$title)

@section('content')
    @include('partials.success-popup')

    <div class="container tablet:mx-auto w-full">
        <div class="flex flex-row items-center px-5 pt-5">
            <h1 id="news-page-title" class="text-2xl font-semibold grow">{{ $title }}</h1>
            @isset($tags)
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
            @endisset
        </div>
        
        <div data-url="{{ $baseUrl }}" id="news-posts-container"
            class="grid grid-cols-1 tablet:grid-cols-2 laptop:grid-cols-3 desktop:grid-cols-4 gap-4">
            {{-- @foreach ($news_posts as $news)
                @include('partials.tile-post', ['news' => $news])
            @endforeach --}}
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

        <div id="no-results" class="hidden flex flex-col items-center justify-center">
            <h1 class="text-white text-xl">No results found.</h1>
            <h1 class="text-gray-500 text-sm">meow..</h1>

            <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 888 342.09"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <path
                    d="m560.17,337.74l-141.49-4.02s10.65-63.71-23.52-81.39c-23.29-12.06-43.96-68.39-38.08-106.72.08-.51.16-1.02.25-1.52,2.98-17.16,11.5-30.45,27.79-34.06,52.66-11.66,90.24-2.62,90.24-2.62,0,0,8.7.11,21.59,2.53.46.08.92.17,1.38.27,36.49,7.15,103.94,32.61,106.86,123.01,4.02,124.2-45.02,104.5-45.02,104.5Z"
                    fill="#3f3d56" />
                <path
                    d="m496.95,109.95c-.24,6.48-1.71,12.92-4.39,19.04-5.56,12.69-15.7,22.38-28.54,27.29-38.46,14.72-83.34.12-106.04-15.71-.09.5-1.89,9.99-1.97,10.5,10.05,6.88,59.24,13.51,68.57,13.51,14.17,0,27.81-2.35,39.94-7,13.19-5.05,23.6-15.01,29.31-28.04,2.73-6.22,4.23-12.75,4.5-19.33-.46-.1-.92-.19-1.38-.27,0,0,0,0,0,0Z"
                    fill="#e8e8e8" />
                <path
                    d="m507.41,118.2l-22.55-56.71s27.07-46.4,5.8-51.55c-21.27-5.16-43.18,22.55-43.18,22.55,0,0-40.6-14.18-56.06-2.58,0,0-25.78-36.09-41.24-29-15.47,7.09,5.5,58.18,5.5,58.18,0,0-31.92,46.86-7.43,73.92,24.49,27.07,116.64,48.98,159.17-14.82h0Z"
                    fill="#3f3d56" />
                <path d="m1,336.08h887v-2H1c-.55,0-1,.45-1,1h0c0,.55.45,1,1,1Z" fill="#3f3d56" />
                <path
                    d="m555.78,303.8c7.68,3.42,15.7,6.9,24.1,6.57s17.23-5.74,18.54-14.04c.68-4.29-.66-8.88.98-12.9,2.21-5.4,9.33-7.49,14.86-5.64,5.54,1.85,9.6,6.63,12.52,11.68,5.46,9.46,7.64,21.88,1.79,31.1-5.07,7.99-14.69,11.61-23.63,14.71-11.92,4.13-25.22,8.22-36.77,3.15-11.61-5.1-17.94-19.83-13.64-31.76"
                    fill="#3f3d56" />
                <path d="m428.74,92.71s-13.88-5.55-22.89,1.39l10.41,15.96s12.49-17.34,12.49-17.34Z" fill="#e8e8e8" />
                <path d="m355.89,165.55l25.67,136.68s-38.85,39.55,11.1,38.85c49.95-.69,35.38-26.36,35.38-26.36l-15.96-118.64"
                    fill="#3f3d56" />
                <path
                    d="m391.4,342.09c-13.53,0-21.71-3.1-24.33-9.23-4.77-11.16,10.76-28.17,13.42-30.97l-17.26-102.18,1.97-.33,17.43,103.18-.36.36c-.18.18-17.94,18.45-13.36,29.15,2.35,5.5,10.32,8.19,23.74,8,18.65-.26,30.67-4.17,34.77-11.3,3.69-6.42-.21-13.5-.25-13.57l-.09-.17-.03-.19-11.1-82.56,1.98-.27,11.08,82.38c.66,1.25,4.11,8.46.16,15.36-4.53,7.9-16.81,12.05-36.49,12.32-.43,0-.85,0-1.27,0Z"
                    fill="#2f2e41" />
                <path d="m421.1,165.55l25.67,136.68s-38.85,39.55,11.1,38.85c49.95-.69,35.38-26.36,35.38-26.36l-15.96-118.64"
                    fill="#3f3d56" />
                <path
                    d="m456.61,342.09c-13.53,0-21.71-3.1-24.33-9.23-4.77-11.14,10.73-28.13,13.41-30.96l-10.31-55,1.97-.37,10.5,56.02-.37.37c-.18.18-17.94,18.45-13.36,29.15,2.35,5.5,10.33,8.2,23.74,8,18.66-.26,30.69-4.17,34.78-11.32,3.69-6.44-.22-13.48-.26-13.55l-.1-.17-15.98-118.83,1.98-.27,15.93,118.46c.66,1.25,4.11,8.46.16,15.36-4.53,7.9-16.81,12.05-36.49,12.32-.43,0-.85,0-1.27,0Z"
                    fill="#2f2e41" />
            </svg>
        </div>
    </div>
@endsection
