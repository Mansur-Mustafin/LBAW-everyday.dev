@extends('layouts.body.default')

@section('content')

@include('partials.success-popup')

<section
    class="flex flex-col tablet:flex-row laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <main class="order-2 tablet:order-none flex-1">
        @php
            $isPostsActive = Route::currentRouteNamed('user.posts');
            $isUpvotesActive = Route::currentRouteNamed('user.upvotes');
        @endphp
        <ul class="flex flex-wrap text-sm font-medium border-b border-gray-800 text-gray-400">
            <li class="me-2">
                <a href="{{ url('/users/' . $user->id . '/posts') }}"
                    class="inline-block px-4 py-2 rounded-lg hover:bg-gray-800 hover:text-white {{ $isPostsActive ? 'text-white' : '' }}">Posts</a>
                <div class="{{ $isPostsActive ? '' : 'hidden' }} border-b border-white border-1 w-4 rounded-xl mx-auto">
                </div>
            </li>
            <li class="me-2">
                <a href="{{ url('/users/' . $user->id . '/upvotes') }}"
                    class="inline-block px-4 py-2 rounded-lg hover:bg-gray-800 hover:text-white {{ $isUpvotesActive ? 'text-white' : '' }}">Upvotes</a>
                <div
                    class="{{ $isUpvotesActive ? '' : 'hidden' }} border-b border-white border-1 w-4 rounded-xl mx-auto">
                </div>
            </li>
        </ul>

        {{-- <p class="text-gray-500 text-center mt-10">
            @if ($isPostsActive)
            {{ $user->public_name }} hasn't posted yet.
            @elseif ($isUpvotesActive)
            {{ $user->public_name }} hasn't upvoted any posts yet.
            @else
            No content available.
            @endif
        </p> --}}

        <div class="container tablet:mx-auto w-full">
            <h1 class="text-2xl font-semibold my-4 mx-4">{{ $title }}</h1>
            <div data-url="{{ $baseUrl }}" id="news-posts-container" class="grid grid-cols-1 gap-4">
            </div>
            <div id="loading-icon" class="hidden">
                <div class="grid grid-cols-1 gap-4">
                    <div>@include('partials.load-tile-post')</div>
                    <div>@include('partials.load-tile-post')</div>
                </div>
                <img class="w-20 h-20 mx-auto" src="{{ url('/assets/loading-icon.gif') }}" alt="Loading...">
            </div>
        </div>

    </main>

    <aside class="order-1 tablet:order-none border-l border-gray-700 tablet:w-[18rem]">
        <header class="flex items-center p-4">
            <h2 class="font-bold text-lg flex-1">Profile</h2>
            <button id="share-profile" class="relative hover:bg-input p-2 rounded-xl">
                <span
                    class="copied-feedback absolute top-10 -left-4 opacity-0 transition-opacity duration-300 text-sm bg-input px-1.5 py-0.5 rounded-lg">copied</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-link">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                </svg>
            </button>
            <div class="relative">
                <button id="profile-options" class="hover:bg-input p-2 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-ellipsis-vertical">
                        <circle cx="12" cy="12" r="1" />
                        <circle cx="12" cy="5" r="1" />
                        <circle cx="12" cy="19" r="1" />
                    </svg>
                </button>
                @include('partials.profile-options')
            </div>

        </header>
        <div class="rounded flex justify-center m-5">
            <img src="{{ $user->profileImage->url }}" alt="Your profile image"
                class="rounded-full w-48 h-48 object-cover border-2 border-white">
        </div>
        <div class="p-4 flex flex-col">
            <p class="font-bold text-lg flex items-center justify-between">
                {{ $user->public_name }}
                @if (Auth::check() and $user->is_admin)
                    <span class="bg-purple text-white px-2 rounded-full text-sm">Admin</span>
                @endif
            </p>
            <div class="flex items-center gap-2">
                <span class="text-gray-300">{{ $user->username }} </span>
                <span class="text-xs text-gray-500"> • Joined {{ $user->created_at->format('F Y') }} </span>
            </div>

        </div>
        <div class="p-4 text-sm flex flex-col">
            <div class="flex items-center justify-between">
                <a href="{{ route('user.following', $user->id) }}">
                    <span class="mr-4">{{ $user->following()->count() }} <span
                            class="text-gray-500">following</span></span>
                </a>
                <a href="{{ route('user.followers', $user->id) }}">
                    <span>{{ $user->followers()->count() }} <span class="text-gray-500">followers</span></span>
                </a>
            </div>
            <div class="flex items-center justify-between">
                <span class="mr-4">{{ $user->rank }} <span class="text-gray-500">rank</span> </span>
                @if (Auth::check() and Auth::id() == $user->id || Auth::user()->is_admin)
                    <span>{{ $user->reputation }} <span class="text-gray-500">reputation</span> </span>
                @endif
            </div>
        </div>
        <div class="p-4 flex flex-col gap-2">
            <h3 class="font-bold text-lg">Favorite Tags</h3>
            <div class="flex gap-2 flex-wrap">
                @foreach ($user->tag_names as $tag)
                    <div class="text-sm text-gray-400 lowercase bg-input px-2 rounded-md">
                        #{{ $tag }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- More info (only admin) -->
        @if (Auth::check() and Auth::user()->is_admin)
            <div class="p-4 flex flex-col gap-2">
                <h3 class="font-bold text-lg">User Info</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-purple text-white px-2 py-1 font-bold rounded-full text-sm ">{{ $user->status }}</span>
                </div>
            </div>
        @endif

        @can('follow', $user)
            <button class="follow-button text-input bg-white font-bold rounded-xl px-4 py-1 mx-2 self-end"
                data-user-id="{{ $user->id }}" data-action="follow">Follow</button>
        @endcan
        @can('unfollow', $user)
            <button class="follow-button text-input bg-white font-bold rounded-xl px-4 py-1 mx-2 self-end"
                data-user-id="{{ $user->id }}" data-action="unfollow">Unfollow</button>
        @endcan
    </aside>
</section>

@include('layouts.footer')

@endsection