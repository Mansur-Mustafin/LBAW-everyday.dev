@extends('layouts.body.single-form')

@section('content')
<div class="flex items-center justify-center">
    <div class="flex items-center justify-center md:flex-row rounded-2xl shadow-2xl shadow-gray-900 max-w-4xl w-full overflow-hidden">

        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center text-white">
            <h2 class="text-3xl font-bold mb-4">Forgot Your Password?</h2>
            <p class="mb-6">
                Enter your new password below and confirm it to reset your account. <br>
                If you didn't request this password reset, you can safely ignore this message.
            </p>
        </div>

        <div class="w-2/3 p-8">
            <form method="POST" action="{{ route('recover.reset') }}" id="registerForm" novalidate class="group">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <h2 class="text-2xl font-bold mb-4 text-center">Reset Password</h2>

                <div class="flex flex-col relative w-full mb-2">
                    <label for="password" class="font-bold text-sm mb-2">Password</label>
                    <input id="password" 
                        type="password" 
                        name="password" 
                        required 
                        class="rounded-2xl bg-input outline-none p-3 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer" 
                        placeholder="Password*"
                        pattern=".{4,}">
                    <span class="toggle-password material-icons cursor-pointer absolute inset-y-10 right-3 text-gray-500">
                        visibility_off
                    </span>
                    <span class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Password must be at least 4 characters long
                    </span>
                    @error('password')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="flex flex-col relative w-full mb-5">
                    <label for="password-confirm" class="font-bold text-sm mb-2">Confirm Password</label>
                    <input id="password-confirm" 
                        type="password" 
                        name="password_confirmation" 
                        required
                        class="rounded-2xl bg-input outline-none p-3 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border peer" 
                        placeholder="Confirm Password*"
                        pattern=".{4,}">
                    <span class="toggle-password material-icons cursor-pointer absolute inset-y-10 right-3 text-gray-500">
                        visibility_off
                    </span>
                    <span class="hidden ml-4 text-red-400 text-sm peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Password must be at least 4 characters long
                    </span>
                    @error('password_confirmation')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="flex items-center justify-between mb-4">
                    <button type="submit" id="submitButton"
                        class="w-1/2 bg-white hover:bg-gray-300 text-black rounded-xl px-6 py-2 font-bold transition duration-200
                        group-invalid:pointer-events-none group-invalid:opacity-60">
                        Reset
                    </button>
                </div>

                @error('email')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror

            </form>
        </div>
    </div>    
</div>
@endsection
