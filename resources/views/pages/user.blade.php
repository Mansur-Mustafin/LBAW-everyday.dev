@extends('layouts.app')

@section('content')

<section class="flex flex-col tablet:flex-row laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <main class="order-2 tablet:order-none flex-1">
        @php
            $isPostsActive = Route::currentRouteNamed('user.posts');
            $isUpvotesActive = Route::currentRouteNamed('user.upvotes');
        @endphp
        <ul class="flex flex-wrap text-sm font-medium border-b border-gray-800 text-gray-400">
            <li class="me-2">
                <a href="{{url('/users/'.$user->id.'/posts')}}" class="inline-block px-4 py-2 rounded-lg hover:bg-gray-800 hover:text-white {{$isPostsActive ? 'text-white' : ''}}">Posts</a>
                <div class="{{$isPostsActive ? '' : 'hidden'}} border-b border-white border-1 w-4 rounded-xl mx-auto"></div>
            </li>
            <li class="me-2">
                <a href="{{url('/users/'.$user->id.'/upvotes')}}" class="inline-block px-4 py-2 rounded-lg hover:bg-gray-800 hover:text-white {{$isUpvotesActive ? 'text-white' : ''}}">Upvotes</a>
                <div class="{{$isUpvotesActive ? '' : 'hidden'}} border-b border-white border-1 w-4 rounded-xl mx-auto"></div>
            </li>
        </ul>

        @if ($news_posts->isEmpty())
            <p class="text-gray-500 text-center mt-10">
                @if ($isPostsActive)
                    {{ $user->public_name }} hasn't posted yet.
                @elseif ($isUpvotesActive)
                    {{ $user->public_name }} hasn't upvoted any posts yet.
                @else
                    No content available.
                @endif
            </p>
        @else
            <div class="container tablet:mx-auto w-full">
                <h1 class="text-2xl font-semibold my-4 mx-4">{{ $title }}</h1>
                <div data-last_page="{{ $news_posts->lastPage() }}" data-url="{{ $baseUrl }}" id="news-posts-container" class="grid grid-cols-1 gap-4">
                    @foreach ($news_posts as $news)
                        @include('partials.tile-post', ['news' => $news])
                    @endforeach
                </div>
                <div id="loading-icon" style="display: none;" class="my-6">
                    <img class="w-12 h-12 mx-auto" src="{{url('/assets/loading-icon.gif')}}" alt="Loading...">
                </div>  
            </div>
        @endif
    </main> 

    <aside class="order-1 tablet:order-none border-l border-gray-700">
        <header class="flex items-center p-4">
            <h2 class="font-bold text-lg flex-1">Profile</h2>
            @if (Auth::user()->id === $user->id)
                <a href="{{url('/users/'.$user->id.'/edit')}}" class="text-input bg-white font-bold rounded-xl px-4 py-1 mx-2 self-end">Edit Profile</a>
            @elseif (Auth::user()->is_admin)
                <a href="{{url('/admin/users/'.$user->id.'/edit')}}" class="text-input bg-white font-bold rounded-xl px-4 py-1 mx-2 self-end">Edit Profile</a>
            @endif
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
            <img src="{{$user->profile_image_path}}" alt="Your profile image" class="rounded-full w-48 h-48 object-cover border-2 border-white">
        </div>
        <div class="p-4">
            <p class="font-bold text-lg">
                {{$user->public_name}}
                @if(Auth::check() and $user->is_admin)
                    <span class="bg-red-400 text-gray-800 px-3 py-1 ml-1 rounded-full text-sm ">Admin</span>
                @endif
            </p>
            <span class="text-gray-300">{{$user->username}} </span> 
            <span class="text-sm text-gray-500"> • Joined {{$user->created_at->format('F Y')}} </span>
            @if(Auth::check() and (Auth::id() == $user->id))
                <p class="text-gray-300">{{$user->email}} </p>
            @endif
        </div>
        <div class="p-4 mt-4">
            <p>
                <a href="{{route('users.following', $user->id)}}">
                    <span class="mr-4">{{ $user->following()->count() }} <span class="text-gray-500">following</span></span>
                </a>
                <a href="{{route('users.followers', $user->id)}}">
                    <span>{{ $user->followers()->count() }} <span class="text-gray-500">followers</span></span>
                </a>
            </p>
            <p>
                <span class="mr-4">{{$user->rank}} <span class="text-gray-500">rank</span> </span>
                @if(Auth::check() and (Auth::id() == $user->id))
                    <span>{{$user->reputation}} <span class="text-gray-500">reputation</span> </span> 
                @endif
            </p>
        </div>
        {{-- <div class="p-4 mt-4">
            <h3 class="font-bold text-lg">Favorite Tags</h3>
            @include('partials.tags', ['tags' => $user->tag_names])
        </div> --}}

        <div class="p-4">
        @if (Auth::check() and (Auth::id() == $user->id))
            <a href="{{ url('/logout') }}" class="text-input bg-red-400 font-bold rounded-xl px-4 py-1 self-end">Logout</a>
        @endif
        </div>

        <!-- More info (only admin) -->
        @if(Auth::check() and (Auth::user()->is_admin))
            <div class="p-4">
                <h3 class="font-bold text-lg">User Info</h3>
                <div class="flex flex-wrap gap-2 mb-2 mt-1">
                    <span class="bg-red-400 text-gray-800 px-3 py-1 ml-2 rounded-full text-sm ">{{$user->status}}</span>
                </div>
            </div>
        @endif
    </aside>
</section>

@endsection