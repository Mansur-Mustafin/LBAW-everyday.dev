<?php
$urlParts = explode('/', url()->current());
$page = end($urlParts);
?>
<aside
    class="relative border-r border-solid border-gray-700 w-16 min-w-16 laptop:min-w-56 p-5 flex flex-col items-center laptop:items-start gap-1 top-[4.93rem]">
    <div class="fixed laptop:w-48 top-[6rem] flex flex-col gap-1 items-center laptop:items-start">
        <a href="{{ route('news.recent') }}"
            class="flex gap-2 p-2 rounded-md hover:bg-gray-700 items-center w-full {{$page == 'recent-feed' ? 'bg-gray-700' : ''}}">
            @include('partials.svg.aside.recent-news')
            <span class="hidden laptop:block">Recent News</span>
        </a>
        @if (Auth::check())
            <a href="{{ route('news.my') }}"
                class="flex gap-2 p-2 rounded-md hover:bg-gray-700 items-center w-full {{$page == 'my-feed' ? 'bg-gray-700' : ''}}">
                @include('partials.svg.aside.your-news')
                <span class="hidden laptop:block">Your News</span>
            </a>

            <a href="{{ route('news.bookmark') }}"
                class="flex gap-2 p-2 rounded-md hover:bg-gray-700 items-center w-full {{$page == 'bookmarks' ? 'bg-gray-700' : ''}}">
                @include('partials.svg.aside.bookmarks')
                <span class="hidden laptop:block">Bookmarks</span>
            </a>
        @endif
    </div>

    <div class="fixed w-48 bottom-3 flex flex-col gap-1 items-center laptop:items-start">
        <a href="{{ route('contacts') }}"
            class="flex p-2 items-center rounded-md hover:bg-gray-700 gap-2 laptop:w-full {{$page == 'contacts' ? 'bg-gray-700' : ''}}">
            @include('partials.svg.aside.contacts')
            <span class="hidden laptop:block">Contacts</span>
        </a>
        <a href="{{ route('about') }}"
            class="flex p-2 items-center rounded-md hover:bg-gray-700 gap-2 laptop:w-full {{$page == 'about-us' ? 'bg-gray-700' : ''}}">
            @include('partials.svg.aside.about-us')
            <span class="hidden laptop:block">About us</span>
        </a>
        <a href="{{ route('features') }}"
            class="flex p-2 items-center rounded-md hover:bg-gray-700 gap-2 laptop:w-full {{$page == 'main-features' ? 'bg-gray-700' : ''}}">
            @include('partials.svg.aside.main-features')
            <span class="hidden laptop:block">Main Features</span>
        </a>
    </div>
</aside>