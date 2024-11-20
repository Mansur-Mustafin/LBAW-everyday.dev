@extends('layouts.app')

@section('body-class', "bg-[url('/public/assets/backg.svg')] bg-cover text-white")

@section('content')
<div class="flex items-center justify-center">
    <div class="flex items-center justify-center flex-col md:flex-row rounded-lg shadow-2xl max-w-4xl w-full overflow-hidden">
        
        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center text-white">
            <h2 class="text-3xl font-bold mb-4">Where developers suffer together</h2>
            <p class="mb-6">
                We know how hard it is to be a developer. It doesn't have to be. Personalized news feed, dev community, and search, much better than what's out there. Maybe ;)
            </p>
        </div>

        <div class="md:w-1/2 p-8">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                
                <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

                <label for="email" class="block font-semibold mb-2">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full p-3 bg-white text-black border-[#5a7d99] rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#5a7d99]">
                @if ($errors->has('email'))
                    <span class="text-red-400 text-sm">
                        {{ $errors->first('email') }}
                    </span>
                @endif

                <label for="password" class="block font-semibold mb-2">Password</label>
                <div class="relative w-full">
                    <input id="password" type="password" name="password" required
                        class="w-full p-3 bg-white text-black border-[#5a7d99] rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#5a7d99]">
                    <span id="toggle-password" class="material-symbols-outlined cursor-pointer absolute inset-y-3 right-0.5 text-gray-500">
                        visibility_off
                    </span>
                </div>
                @if ($errors->has('password'))
                    <span class="text-red-400 text-sm">
                        {{ $errors->first('password') }}
                    </span>
                @endif

                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center text-sm">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="text-[#b8d0c3] bg-gray-600 rounded border-[#b8d0c3] focus:ring-[#b8d0c3]">
                        <span class="ml-2">Remember Me</span>
                    </label>
                    <a href="">Forgot Password?</a>
                </div>

                <button type="submit" class="w-full bg-[#5a7d99] hover:bg-[#34547c] font-extrabold py-2 rounded transition duration-200">
                    Login
                </button>

                <div class="text-center mt-4">
                    <span class="text-gray-400">Don’t have an account?</span>
                    <a href="{{ route('register') }}" class="text-[#5a7d99] hover:text-[#34547c] font-semibold">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
