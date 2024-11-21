@extends('layouts.app')

@section('content')

<section class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">

    <h2 class="text-2xl font-semibold my-4 mx-4">Edit Profile</h2>

    <form method="POST" action="{{ url('users/' . $user->id) }}" enctype="multipart/form-data" 
        class="px-3 flex flex-col gap-4 mt-4" id="edit-profile">
        @csrf
        @method('PUT')
        <h3 class="font-bold text-lg flex-1">Profile Picture</h3>

        <div class="flex">
            <button type="button" class="rounded flex justify-center m-5" id="personalizedFileInput" title="Click to upload Image">
                <img class="rounded-full w-48 h-48 object-cover border-2 border-white" src="{{$user->profile_image_path}}" alt="Current Profile Image">
            </button>
            <button type="button" id="deleteThumbnail" class="self-start hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-x">
                <circle cx="12" cy="12" r="10" />
                <path d="m15 9-6 6" />
                <path d="m9 9 6 6" />
                </svg>
            </button>
            @error('image')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <input class="hidden" type="file" id="realFileInput" name="image">

        <h3 class="font-bold text-lg flex-1">User Information</h3>

        <div class="flex flex-col">
            <label class="font-bold text-sm">Public Name</label>
            <input name="public_name" class="rounded-2xl bg-input outline-none p-3" placeholder="Public Name*" value="{{ old('public_name', $user->public_name) }}">
            @error('public_name')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label class="font-bold text-sm">Username</label>
            <input name="username" class="rounded-2xl bg-input outline-none p-3" placeholder="Username*" value="{{ old('username', $user->username) }}">
            @error('username')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label class="font-bold text-sm">Email</label>
            <input name="email" class="rounded-2xl bg-input outline-none p-3" placeholder="Email*" value="{{ old('email', $user->email) }}">
            @error('email')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button class="text-input bg-white font-bold rounded-xl px-6 py-2 self-end" type="submit">Save Changes</button>
    </form>

</section>

@endsection