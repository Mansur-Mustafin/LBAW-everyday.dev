@extends('layouts.app')

@section('content')

<section class="flex flex-col tablet:flex-row laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <main class="order-2 tablet:order-none flex-1">
        Main
    </main>

    <aside class="order-1 tablet:order-none border-l border-gray-700">
        <header class="flex items-center p-4">
            <h2 class="font-bold text-lg flex-1">Profile</h2>
            @if(Auth::check() and (Auth::id() == $user->id))
                <a href="" class="text-input bg-white font-bold rounded-xl px-4 py-1 mx-2 self-end">Edit Profile</a>
            @endif
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
                <span class="mr-4">{{ $user->following()->count() }} <span class="text-gray-500">following</span></span>
                <span>{{ $user->followers()->count() }} <span class="text-gray-500">followers</span></span>
            </p>
            <p>
                <span class="mr-4">{{$user->rank}} <span class="text-gray-500">rank</span> </span>
                @if(Auth::check() and (Auth::id() == $user->id))
                    <span>{{$user->reputation}} <span class="text-gray-500">reputation</span> </span> 
                @endif
            </p>
        </div>
        <div class="p-4 mt-4">
            <h3 class="font-bold text-lg">Favorite Tags</h3>
            @include('partials.tags', ['tags' => $user->tag_names])
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