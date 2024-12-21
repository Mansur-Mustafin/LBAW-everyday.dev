@extends('layouts.body.default')

@section('content')

@include('partials.success-popup')

<section
    class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full p-5">

    <form method="POST" action="{{ route('admin.update', $user->id) }}" enctype="multipart/form-data"
        class="flex flex-col gap-4" id="admin-edit-profile">
        @csrf
        @method('PUT')
        <h3 class="font-bold text-lg flex-1">Profile Picture</h3>

        <div class="flex" id="edit-image">
            <button type="button" class="rounded flex justify-center m-5" id="personalizedFileInput"
                title="Click to upload Image">
                <img class="rounded-full w-48 h-48 object-cover border-2 border-white"
                    src="{{ $user->profileImage->url }}" alt="Current Profile Image">
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
            <label class="font-bold text-sm mb-2">Username</label>
            <input name="username" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Username*"
                value="{{ old('username', $user->username) }}">
            @error('username')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label class="font-bold text-sm mb-2">Email</label>
            <input name="email" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Email*"
                value="{{ old('email', $user->email) }}">
            @error('email')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label class="font-bold text-sm mb-2">Reputation</label>
            <input name="reputation" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Reputation*"
                value="{{ old('reputation', $user->reputation) }}">
            @error('reputation')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col relative w-full">
            <label class="font-bold text-sm mb-2">New Password</label>
            <input name="new_password" type="password" class="rounded-2xl bg-input outline-none p-3 text-sm"
                placeholder="New Password*">
            <span class="toggle-password material-icons cursor-pointer absolute inset-y-8 right-3 text-gray-500">
                visibility_off
            </span>
            @error('new_password')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div class="flex justify-between items-center">
            {{-- CREATE TYPE UserStatus AS ENUM ('active', 'blocked', 'pending', 'deleted'); --}}
            {{-- <div class="flex flex-col">
                <label class="font-bold text-sm">User Status</label>
                <select class="bg-input rounded-2xl p-3 w-40" id="tagSelector">
                    <option selected disabled></option>
                    <option value='active'>active</option>
                    <option value='blocked'>blocked</option>
                    <option value='pending'>pending</option>
                    <option value='deleted'>deleted</option>
                </select>
                @error('user-status')
                <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div> --}}
        </div>

        <h3 class="font-bold text-lg flex-1">User Privilegies</h3>

        <div class="flex flex-col">
            <label class="font-bold text-sm mb-2">Admin Privilegies</label>
            <div class="toggleTwo mb-4" data-name="Admin" data-initialvalue="{{ $user->is_admin ? 'true' : 'false'}}">
                <input class="hidden hiddenToggle" type="text" name="is_admin"
                    value='{{$user->is_admin ? 'true' : 'false'}}'>
            </div>
            @if ($user->is_admin)
                <div id="admPassword" class="hidden flex flex-col relative w-full">
                    <label class="font-bold mb-2 text-sm">Administrative Password</label>
                    <div class="flex flex-col relative w-full"> {{-- Muito mal feito, no futuro refaco --}}
                        <input name="adm_password" type="password" class="rounded-2xl bg-input outline-none p-3 text-sm"
                            placeholder="Administrative Password*">
                        <span
                            class="toggle-password material-icons cursor-pointer absolute inset-y-3 right-3 text-gray-500">
                            visibility_off
                        </span>
                    </div>
                </div>
            @endif
            @error('adm_password')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex gap-2 self-end">
            <a href="{{ url('/admin') }}" class="text-input bg-white font-bold rounded-xl px-6 py-2">Cancel</a>
            <button class="loading-button text-input bg-white font-bold rounded-xl px-6 py-2"
                type="submit">Save</button>
        </div>
    </form>
</section>
@endsection