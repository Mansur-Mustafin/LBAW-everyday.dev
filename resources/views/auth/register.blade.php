@extends('layouts.login')

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
          <form method="POST" action="{{ route('register') }}" class="flex flex-col items-center mx-auto my-auto max-w-md p-6 rounded">
            {{ csrf_field() }}

            <label for="username" class="block font-semibold mb-2">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus class="w-full p-3 bg-white text-black border-[#5a7d99] rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#5a7d99]">
            @if ($errors->has('username'))
                <span class="text-red-400 text-sm">
                  {{ $errors->first('username') }}
              </span>
            @endif

            <label for="public_name" class="block font-semibold mb-2">Public name</label>
            <input id="public_name" type="text" name="public_name" value="{{ old('public_name') }}" required autofocus class="w-full p-3 bg-white text-black border-[#5a7d99] rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#5a7d99]">
            @if ($errors->has('public_name'))
                <span class="text-red-400 text-sm">
                  {{ $errors->first('public_name') }}
              </span>
            @endif

            <label for="email" class="block font-semibold mb-2">E-Mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full p-3 bg-white text-black border-[#5a7d99] rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#5a7d99]">
            @if ($errors->has('email'))
              <span class="text-red-400 text-sm">
                  {{ $errors->first('email') }}
              </span>
            @endif

            <label for="password" class="block font-semibold mb-2">Password</label>
            <div class="relative w-full">
              <input id="password" type="password" name="password" required class="w-full p-3 bg-white text-black border-[#5a7d99] rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#5a7d99]">
              <span id="toggle-password" class="material-symbols-outlined cursor-pointer absolute inset-y-3 right-0.5 text-gray-500">
                visibility
              </span>
            </div>
            @if ($errors->has('password'))
              <span class="text-red-400 text-sm">
                  {{ $errors->first('password') }}
              </span>
            @endif

            <label for="password-confirm" class="block font-semibold mb-2">Confirm Password</label>
            <div class="relative w-full">
              <input id="password-confirm" type="password" name="password_confirmation" required class="w-full p-3 bg-white text-black border-[#5a7d99] rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#5a7d99]">
              <span id="toggle-password-confirm" class="material-symbols-outlined cursor-pointer absolute inset-y-3 right-0.5 text-gray-500">
                visibility
              </span>
            </div>

            <button type="submit" class="mt-4 w-full bg-[#5a7d99] hover:bg-[#34547c] text-white font-extrabold py-2 rounded transition duration-200">
              Register
            </button>
          </form>
        </div>
    </div>
</div>
@endsection