@extends('layouts.body.default')

@section('title', 'Edit User Admin')

@section('content')

@include('partials.success-popup')

<section
    class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full p-5">

    <form method="POST" action="{{ route('admin.update', $user->id) }}" enctype="multipart/form-data"
        class="flex flex-col gap-4" id="admin-edit-profile">
        @csrf
        @method('PUT')
        <fieldset>
            <legend class="hidden">Personal Information</legend>
            <h3 class="font-bold text-lg flex-1 mb-4">Profile Picture</h3>

            <div class="flex" id="edit-image">
                <button type="button" class="rounded flex justify-center" id="personalizedFileInput"
                    title="Click to upload Image">
                    <img class="rounded-full w-48 h-48 object-cover border-2 border-white"
                        src="{{ $user->profileImage->url }}" alt="Current Profile Image">
                </button>
                <button class="hidden bg-input rounded-3xl px-6 py-8 w-40 min-h-28 text-sm" id="buttonAddImage"
                    title="Click to upload new Image">
                    Upload image
                </button>
                <button type="button" id="deleteThumbnail" class="self-start">
                    @include('partials.svg.circle-x')
                </button>
                @error('image')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <input class="hidden" type="file" id="realFileInput" name="image" accept=".png, .jpg, .jpeg, .gif">
            <input class="hidden" id="fileRemoved" name="remove_image" value="false">

            <h3 class="font-bold text-lg flex-1 my-3">User Information</h3>

            <div class="flex flex-col">
                <label class="font-bold text-sm mb-2">Public Name</label>
                <input name="public_name" class="rounded-2xl bg-input outline-none p-3 text-sm"
                    placeholder="Public Name*" value="{{ old('public_name', $user->public_name) }}">
                @error('public_name')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="font-bold text-sm my-2">Username</label>
                <input name="username" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Username*"
                    value="{{ old('username', $user->username) }}">
                @error('username')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="font-bold text-sm my-2">Email</label>
                <input name="email" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Email*"
                    value="{{ old('email', $user->email) }}">
                @error('email')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="font-bold text-sm my-2">Reputation</label>
                <input name="reputation" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Reputation*"
                    value="{{ old('reputation', $user->reputation) }}">
                @error('reputation')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col relative w-full">
                <label class="font-bold text-sm my-2">New Password</label>
                <input name="new_password" type="password" class="rounded-2xl bg-input outline-none p-3 text-sm"
                    placeholder="New Password*">
                <span title="change visibility"
                    class="toggle-password material-icons cursor-pointer absolute inset-y-9 right-3 text-gray-500">
                    visibility_off
                </span>
                @error('new_password')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <h3 class="font-bold text-lg flex-1 my-3">User Privilegies</h3>

            <div class="flex flex-col">
                <label class="font-bold text-sm mb-2">Admin Privilegies</label>
                <div class="toggleTwo mb-4" data-name="Admin"
                    data-initialvalue="{{ $user->is_admin ? 'true' : 'false'}}">
                    <input class="hidden hiddenToggle" type="text" name="is_admin"
                        value='{{$user->is_admin ? 'true' : 'false'}}'>
                </div>
                @if ($user->is_admin)
                    <div id="admPassword" class="hidden flex flex-col relative w-full">
                        <label class="font-bold mb-2 text-sm">Administrative Password</label>
                        <div class="flex flex-col relative w-full"> {{-- Muito mal feito, no futuro refaco --}}
                            <input name="adm_password" type="password" class="rounded-2xl bg-input outline-none p-3 text-sm"
                                placeholder="Administrative Password*">
                            <span title="change visibility"
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

            <div class="flex gap-2 justify-end mt-4">
                <a href="{{ url('/admin') }}" class="text-input bg-white font-bold rounded-xl px-6 py-2">Cancel</a>
                <button class="loading-button text-input bg-white font-bold rounded-xl px-6 py-2"
                    type="submit">Save</button>
            </div>
            <fieldset>
    </form>
</section>
@endsection