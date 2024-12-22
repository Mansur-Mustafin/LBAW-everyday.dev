@extends('layouts.body.single-form')

@include('partials.success-popup')

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
            <form method="POST" action="{{ route('login') }}" novalidate class="group">
                <fieldset>
                <legend class="hidden">Login Credencials</legend>
                {{ csrf_field() }}

                <h2 class="text-2xl font-bold mb-4 text-center">Log in</h2>

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

                <div class="mb-2 flex justify-center text-sm">
                    <p>or</p>
                </div>

                <div class="flex flex-col mb-2">
                    <label for="email"></label>
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

                <div class="flex flex-col relative w-full mb-7">
                    <label for="password"></label>
                    <input id="password" type="password" name="password" required placeholder="Password*"
                        class="rounded-2xl bg-input outline-none p-3 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                        pattern=".{4,}">
                    <span title="change visibility"
                        class="toggle-password material-icons cursor-pointer absolute inset-y-3 right-3 text-gray-500">
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

                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center text-sm">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                            class="form-checkbox bg-gray-600 rounded accent-[#5a7d99]">
                        <span class="ml-2">Remember Me</span>
                    </label>
                    <button type="submit" class="w-1/2 bg-white hover:bg-gray-300 text-black rounded-xl px-6 py-2 font-bold transition duration-200 
                        group-invalid:pointer-events-none group-invalid:opacity-60">
                        Login
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-gray-400">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-white underline">Register</a>
                    <p><a href="{{ route('recover.form') }}" class="text-white underline">Forgot Password?</a></p>
                </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection