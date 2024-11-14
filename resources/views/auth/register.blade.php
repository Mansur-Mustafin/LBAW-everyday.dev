@extends('layouts.app')

@section('content')
<div class="container mx-auto">

  <form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="mb-4">
      <label for="name" class="block font-bold mb-2">Name</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
      class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }}
      </span>
    @endif

    <div class="mb-4">
      <label for="username" class="block font-bold mb-2">Username</label>
      <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
      class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    @if ($errors->has('username'))
        <span class="error">
          {{ $errors->first('username') }}
      </span>
    @endif

    <div class="mb-4">
      <label for="public_name" class="block font-bold mb-2">Public name</label>
      <input id="public_name" type="text" name="public_name" value="{{ old('public_name') }}" required autofocus
      class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    @if ($errors->has('public_name'))
        <span class="error">
          {{ $errors->first('public_name') }}
      </span>
    @endif

    <div class="mb-4">
      <label for="email" class="block font-bold mb-2">E-Mail Address</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required
      class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
      @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif

    <div class="mb-4">
      <label for="password" class="block font-bold mb-2">Password</label>
      <input id="password" type="password" name="password" required
      class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
      @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif

    <label for="password-confirm" class="block font-bold mb-2">Confirm Password</label>
    <input style="color: #1a202c" id="password-confirm" type="password" name="password_confirmation" required
    class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

    <button type="submit">
      Register
    </button>
    <a class="button button-outline" href="{{ route('login') }}">Login</a>
</form>

</div>
@endsection