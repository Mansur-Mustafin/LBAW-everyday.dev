@extends('layouts.app')

@section('content')
<div class="container mx-auto">

    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
    
        {{-- <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus> --}}
    
        <div class="mb-4">
            <label for="email" class="block font-bold mb-2">Email:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        @if ($errors->has('email'))
            <span class="error">
              {{ $errors->first('email') }}
            </span>
        @endif
    
        {{-- <label for="password" >Password</label>
        <input id="password" type="password" name="password" required> --}}

        <div class="mb-4">
            <label for="password" class="block font-bold mb-2">Password:</label>
            <input id="password" type="password" name="password" required
                   class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
        @endif
            
        <label class="block font-bold mb-2">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>
    
        <button type="submit">
            Login
        </button>
        <a class="button button-outline" href="{{ route('register') }}">Register</a>
        @if (session('success'))
            <p class="success">
                {{ session('success') }}
            </p>
        @endif
    </form>

</div>
@endsection