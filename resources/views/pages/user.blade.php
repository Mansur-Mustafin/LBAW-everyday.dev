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
            <div data-url="{{ $baseUrl }}" id="news-posts-container"
                class="grid grid-cols-1 gap-4">
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

    <aside class="order-1 tablet:order-none border-l border-gray-700">
        <header class="flex items-center p-4">
            <h2 class="font-bold text-lg flex-1">Profile</h2>
            @can('follow', $user)
                <button class="follow-button text-input bg-white font-bold rounded-xl px-4 py-1 mx-2 self-end"
                    data-user-id="{{ $user->id }}" data-action="follow">Follow</button>
            @endcan
            @can('unfollow', $user)
                <button class="follow-button text-input bg-white font-bold rounded-xl px-4 py-1 mx-2 self-end"
                    data-user-id="{{ $user->id }}" data-action="unfollow">Unfollow</button>
            @endcan
        </header>
        <div class="rounded flex justify-center m-5">
            <img src="{{ $user->profileImage->url }}" alt="Your profile image"
                class="rounded-full w-48 h-48 object-cover border-2 border-white">
        </div>
        <div class="p-4">
            <p class="font-bold text-lg">
                {{ $user->public_name }}
                @if (Auth::check() and $user->is_admin)
                    <span class="bg-red-400 text-gray-800 px-3 py-1 ml-1 rounded-full text-sm ">Admin</span>
                @endif
            </p>
            <span class="text-gray-300">{{ $user->username }} </span>
            <span class="text-sm text-gray-500"> • Joined {{ $user->created_at->format('F Y') }} </span>
            @if (Auth::check() and Auth::id() == $user->id)
                <p class="text-gray-300">{{ $user->email }} </p>
            @endif
        </div>
        <div class="p-4 mt-4">
            <p>
                <a href="{{ route('user.following', $user->id) }}">
                    <span class="mr-4">{{ $user->following()->count() }} <span
                            class="text-gray-500">following</span></span>
                </a>
                <a href="{{ route('user.followers', $user->id) }}">
                    <span>{{ $user->followers()->count() }} <span class="text-gray-500">followers</span></span>
                </a>
            </p>
            <p>
                <span class="mr-4">{{ $user->rank }} <span class="text-gray-500">rank</span> </span>
                @if (Auth::check() and Auth::id() == $user->id || Auth::user()->is_admin)
                    <span>{{ $user->reputation }} <span class="text-gray-500">reputation</span> </span>
                @endif
            </p>
        </div>
        <div class="p-4 mt-4">
            <h3 class="font-bold text-lg">Favorite Tags</h3>
            @include('partials.tags', ['tags' => $user->tag_names])
        </div>

        <div class="p-4 flex flex-col gap-2 justify-center">
            @if (Auth::check() and (Auth::id() == $user->id))
                <a href="{{ url('/tag_proposal/create') }}"
                    class="text-input bg-white font-bold rounded-lg px-4 py-1">Create tag Proposal</a>
            @endif
            @if (Auth::user()->id === $user->id)
                <a href="{{url('/users/' . $user->id . '/edit')}}"
                    class="text-input bg-white font-bold rounded-lg px-4 py-1">Edit Profile</a>
            @elseif (Auth::user()->is_admin)
                <a href="{{url('/admin/users/' . $user->id . '/edit')}}"
                    class="text-input bg-white font-bold rounded-lg px-4 py-1">Edit Profile</a>
            @endif
            @if (Auth::check() and (Auth::id() == $user->id))
                <a href="{{ url('/logout') }}"
                    class="text-input bg-red-400 font-bold rounded-lg px-4 py-1">Logout</a>
            @endif
        </div>


        <!-- More info (only admin) -->
        @if (Auth::check() and Auth::user()->is_admin)
            <div class="p-4">
                <h3 class="font-bold text-lg">User Info</h3>
                <div class="flex flex-wrap gap-2 mb-2 mt-1">
                    <span class="bg-red-400 text-gray-800 px-3 py-1 ml-2 rounded-full text-sm ">{{ $user->status }}</span>
                </div>
            </div>
        @endif
    </aside>
</section>
<footer class="bg-background text-white py-4 w-full border-t border-solid border-gray-700 hidden" id="profile-footer">
    <div class="flex justify-between items-center">
        <p class="text-3xl">everyday.dev</p>
        <p class="text-sm mr-5">&copy; {{ date('Y') }} everyday.dev | All rights reserved.</p>
    </div>
</footer>


@endsection