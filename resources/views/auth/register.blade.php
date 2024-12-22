@extends('layouts.body.single-form')

@section('content')
<div class="flex items-center justify-center">
    <div
        class="flex items-center justify-center md:flex-row rounded-2xl shadow-2xl shadow-gray-900 max-w-4xl w-full overflow-hidden">

        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center text-white">
            <h2 class="text-3xl font-bold mb-4">Where developers suffer together</h2>
            <p class="mb-6">
                We know how hard it is to be a developer. It doesn't have to be. Personalized news feed, dev community,
                and search, much better than what's out there. Maybe ;)
            </p>
        </div>

        <div class="md:w-1/2 p-8 w-full">
            <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate class="group">
                {{ csrf_field() }}

                <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>

                <div class="flex flex-col mb-2">
                    <a href="{{ route('google-auth') }}"
                        class="rounded-2xl bg-white hover:bg-gray-300 outline-none p-3 cursor-pointer flex flex-row justify-center gap-2 transition duration-200">
                        @include('partials.svg.google-auth')
                        <p class="font-semibold text-black">Google</p>
                    </a>
                </div>
                @error('google-email')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror

                <div class="flex flex-col mb-2">
                    <label for="username" class="font-bold text-sm mb-2">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                        placeholder="Username*" pattern="^\S+$"
                        class="rounded-2xl bg-input outline-none p-3 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer">
                    <span
                        class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Username cannot contain spaces.
                    </span>
                    @error('username')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col mb-2">
                    <label for="public_name" class="font-bold text-sm mb-2">Public name</label>
                    <input id="public_name" type="text" name="public_name" value="{{ old('public_name') }}" required
                        placeholder="Public name*" class="rounded-2xl bg-input outline-none p-3">
                    @error('public_name')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col mb-2">
                    <label for="email" class="font-bold text-sm mb-2">E-Mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Email*"
                        class="rounded-2xl bg-input outline-none p-3 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                        pattern="^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$">
                    <span
                        class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Please enter a valid email address
                    </span>
                    @error('email')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col relative w-full mb-2">
                    <label for="password" class="font-bold text-sm mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                        class="rounded-2xl bg-input outline-none p-3 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                        placeholder="Password*" pattern=".{4,}">
                    <span title="change visibility"
                        class="toggle-password material-icons cursor-pointer absolute inset-y-10 right-3 text-gray-500">
                        visibility_off
                    </span>
                    <span
                        class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Password must be at least 4 characters long
                    </span>
                    @error('password')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col relative w-full mb-5">
                    <label for="password-confirm" class="font-bold text-sm mb-2">Confirm Password</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required
                        class="rounded-2xl bg-input outline-none p-3 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                        placeholder="Confirm Password*" pattern=".{4,}">
                    <span title="change visibility"
                        class="toggle-password material-icons cursor-pointer absolute inset-y-10 right-3 text-gray-500">
                        visibility_off
                    </span>
                    <span
                        class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Password must be at least 4 characters long
                    </span>
                    @error('password_confirmation')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <label class="inline-flex items-center text-sm mb-2">
                    <input type="checkbox" name="age" id="ageCheckbox"
                        class="form-checkbox bg-gray-600 rounded accent-[#5a7d99]" required>
                    <span class="ml-2">I confirm that I am over 13 years old</span>
                </label>
                <p class="mb-4"><span id="checkboxError" class="text-red-500 text-sm hidden">You need to confirm that
                        you're over 13 years old.</span></p>

                <div class="flex items-center justify-between mb-4">
                    <a href="{{ route('login') }}"
                        class="text-gray-300 hover:text-white hover:underline transition duration-200">Back to Login</a>
                    <button type="submit" id="submitButton" class="loading-button w-1/2 bg-white hover:bg-gray-300 text-black rounded-xl px-6 py-2 font-bold transition duration-200
                        group-invalid:pointer-events-none group-invalid:opacity-60">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection