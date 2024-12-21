@extends('layouts.body.default')

@section('content')

<section
    class="flex flex-col p-5 laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">

    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data"
        class="flex flex-col gap-4 group" novalidate>
        @csrf
        @method('PUT')
        <h3 class="font-bold text-lg flex-1">Profile Picture</h3>

        <div class="flex" id="edit-image">
            <button type="button" class="rounded flex justify-center m-5" id="personalizedFileInput"
                title="Click to upload Image">
                <img class="rounded-full w-48 h-48 object-cover border-2 border-white"
                    src="{{$user->profileImage->url}}" alt="Current Profile Image">
            </button>
            <button class="hidden bg-input rounded-3xl px-6 py-8 w-40 min-h-28 text-sm" id="buttonAddImage"
                title="Click to upload new Image">
                Upload image
            </button>
            <button type="button" id="deleteThumbnail" class="self-start">
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
        <input class="hidden" id="fileRemoved" name="remove_image" value="false">

        <h3 class="font-bold text-lg flex-1">User Information</h3>

        <div class="flex flex-col">
            <label class="font-bold text-sm mb-2">Public Name</label>
            <input name="public_name" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Public Name*"
                value="{{ old('public_name', $user->public_name) }}">
            @error('public_name')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="username" class="font-bold text-sm mb-2">Username</label>
            <input id="username" 
                type="text" 
                name="username" 
                value="{{ old('username', $user->username) }}" 
                required 
                autofocus
                placeholder="Username*" 
                required
                pattern="^\S+$"
                class="rounded-2xl bg-input outline-none p-3 text-sm invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer">
            <span class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                Username cannot contain spaces.
            </span>
            @error('username')
            <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>
    
        {{-- TODO: disabled? --}}
        <div class="flex flex-col mb-2">
            <label for="email" class="font-bold text-sm mb-2">E-Mail</label>
            <input id="email" 
                type="email" 
                name="email" 
                value="{{ old('email', $user->email) }}" 
                required
                placeholder="Email*" 
                class="disabled rounded-2xl bg-input outline-none p-3 text-sm invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                pattern="^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$">
            <span class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                Please enter a valid email address
            </span>
            @error('email')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <h3 class="font-bold text-lg flex-1">Reset Password</h3>
            <p class="text-sm text-gray-500">Leave the password fields empty if you do not wish to reset your password.</p>
        </div>

        @if (!is_null($user->password))
            <div class="flex flex-col relative w-full">
                <label for="old_password" class="font-bold text-sm mb-2">Old Password</label>
                <input id="old_password" 
                    name="old_password" 
                    type="password" 
                    class="rounded-2xl bg-input outline-none p-3 text-sm invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                    placeholder="Old Password*"
                    pattern=".{4,}">
                <span class="toggle-password material-icons cursor-pointer absolute inset-y-9 right-3 text-gray-500">
                    visibility_off
                </span>
                <span class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Password must be at least 4 characters long
                </span>
                @error('old_password')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <div class="flex flex-col relative w-full">
            <label for="new_password" class="font-bold text-sm mb-2">New Password</label>
            <input id="new_password" 
                name="new_password" 
                type="password" 
                class="rounded-2xl bg-input outline-none p-3 text-sm invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                placeholder="New Password*"
                pattern=".{4,}">
            <span class="toggle-password material-icons cursor-pointer absolute inset-y-9 right-3 text-gray-500">
                visibility_off
            </span>
            <span class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                Password must be at least 4 characters long
            </span>
            @error('new_password')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col relative w-full">
            <label for="new_password_confirmation" class="font-bold text-sm mb-2">Confirm Password</label>
            <input id="new_password_confirmation" 
                name="new_password_confirmation" 
                type="password" 
                class="rounded-2xl bg-input outline-none p-3 text-sm invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                placeholder="Confirm Password*"
                pattern=".{4,}">
            <span class="toggle-password material-icons cursor-pointer absolute inset-y-9 right-3 text-gray-500">
                visibility_off
            </span>
            <span class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                Password must be at least 4 characters long
            </span>
            @error('new_password_confirmation')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex gap-2 self-end mb-4">
            <a href="{{ url('/users/' . $user->id . '/posts') }}"
                class="text-input bg-red-400 font-bold rounded-xl px-6 py-2">Cancel</a>
            <button class="loading-button text-input bg-white font-bold rounded-xl px-6 py-2 
                group-invalid:pointer-events-none group-invalid:opacity-60" type="submit">Save</button>
        </div>
    </form>

</section>

@endsection