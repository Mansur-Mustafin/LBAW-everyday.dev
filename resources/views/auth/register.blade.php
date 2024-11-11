@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <label for="name">Name</label>
    <input style="color: #1a202c" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }}
      </span>
    @endif

    <label for="username">Username</label>
    <input style="color: #1a202c" id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('username'))
        <span class="error">
          {{ $errors->first('username') }}
      </span>
    @endif

    <label for="public_name">Public name</label>
    <input style="color: #1a202c" id="public_name" type="text" name="public_name" value="{{ old('public_name') }}" required autofocus>
    @if ($errors->has('public_name'))
        <span class="error">
          {{ $errors->first('public_name') }}
      </span>
    @endif

    <label for="email">E-Mail Address</label>
    <input style="color: #1a202c" id="email" type="email" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif

    <label for="password">Password</label>
    <input style="color: #1a202c" id="password" type="password" name="password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif

    <label for="password-confirm">Confirm Password</label>
    <input style="color: #1a202c" id="password-confirm" type="password" name="password_confirmation" required>

    <label for="rank">Rank</label>
    <input style="color: #1a202c" id="rank" type="rank" name="rank" required>

    <button type="submit">
      Register
    </button>
    <a class="button button-outline" href="{{ route('login') }}">Login</a>
</form>
@endsection