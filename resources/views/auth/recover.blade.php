@extends('layouts.body.single-form')

@section('content')
<div class="flex items-center justify-center">
    <div class="flex items-center justify-center md:flex-row rounded-2xl shadow-2xl shadow-gray-900 max-w-4xl w-full overflow-hidden">

        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center text-white">
            <h2 class="text-3xl font-bold mb-4">Reset Your Password</h2>
            <p class="mb-6">
                Enter your email address below, and we'll send you a link to reset your password.
            </p>
        </div>

        <div class="w-2/3 p-8">
            <form method="POST" action="{{ route('email.recover') }}" novalidate class="group">
                @csrf

                <h2 class="text-2xl font-bold mb-4 text-center">Forgot Password?</h2>

                <div class="flex flex-col mb-4">
                    <label for="email" class="font-bold text-sm mb-2">E-Mail</label>
                    <input id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        placeholder="Email*" 
                        class="rounded-2xl bg-input outline-none p-3 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer"
                        pattern="^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$">
                    <span class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Please enter a valid email address
                    </span>
                    @error('email')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-4">
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white hover:underline transition duration-200">Back to Login</a>
                    <button type="submit" id="submitButton"
                        class="loading-button w-1/2 bg-white hover:bg-gray-300 text-black rounded-xl px-6 py-2 font-bold transition duration-200
                        group-invalid:pointer-events-none group-invalid:opacity-60">
                        Send Reset Link
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
