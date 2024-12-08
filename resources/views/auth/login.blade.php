@extends('layouts.body.single-form')

@include('partials.success-popup')

@section('content')
<div class="flex items-center justify-center">
    <div class="flex items-center justify-center md:flex-row rounded-2xl shadow-2xl shadow-gray-900 max-w-4xl w-full overflow-hidden">

        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center text-white">
            <h2 class="text-3xl font-bold mb-4">Where developers suffer together</h2>
            <p class="mb-6">
                We know how hard it is to be a developer. It doesn't have to be. Personalized news feed, dev community,
                and search, much better than what's out there. Maybe ;)
            </p>
        </div>

        <div class="md:w-1/2 p-8 w-full">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <h2 class="text-2xl font-bold mb-4 text-center">Log in</h2>

                <div class="flex flex-col mb-2">
                    <a href="{{ route('google-auth') }}"
                        class="rounded-2xl bg-white hover:bg-gray-300 outline-none p-3 cursor-pointer flex flex-row justify-center gap-2 transition duration-200">
                        <svg width="24px" height="24px" viewBox="-0.5 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Google-color</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Color-" transform="translate(-401.000000, -860.000000)"> <g id="Google" transform="translate(401.000000, 860.000000)"> <path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"> </path> <path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"> </path> <path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"> </path> <path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"> </path> </g> </g> </g> </g></svg>
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
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="Email*" class="rounded-2xl bg-input outline-none p-3">
                    @error('email')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col relative w-full mb-7">
                    <input id="password" type="password" name="password" required placeholder="Password*"
                        class="rounded-2xl bg-input outline-none p-3">
                    <span
                        class="toggle-password material-icons cursor-pointer absolute inset-y-3 right-3 text-gray-500">
                        visibility_off
                    </span>
                    @error('password')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center text-sm">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                            class="bg-gray-600 rounded accent-[#5a7d99]">
                        <span class="ml-2">Remember Me</span>
                    </label>
                    <button type="submit"
                        class="w-1/2 bg-white hover:bg-gray-300 text-black rounded-xl px-6 py-2 font-bold transition duration-200">
                        Login
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-gray-400">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-white underline">Register</a>
                    <p><a href="{{ route('recover.form') }}" class="text-white underline">Forgot Password?</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
