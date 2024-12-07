@extends('layouts.body.default')

@section('content')

@include('partials.success-popup')

<div class="container mx-auto flex flex-col gap-2 mt-4 laptop:m-auto laptop:max-w-[42.5rem]">

  <h1 class="text-7xl border-b border-gray-700">
    Users
  </h1>

  <div class="flex text-black bg-white rounded p-2 tablet:mx-0 mx-2 mt-4">
    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" viewBox="0 0 30 30">
      <path
        d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
      </path>
    </svg>
    <input data-url="{{ url('') }}" id="admin-search-bar" type="text"
      class="laptop:h-full laptop:p-2 outline-none rounded-t laptop:w-full text-lg laptop:text-xl">
  </div>

  <a href="{{url('admin/users/create')}}"
    class="flex flex-col border text-white bg-black border-gray-700 rounded text-2xl items-center justify-center p-2 mx-2 tablet:mx-0">
    <p class="w-fit">
      Create new user
    </p>
  </a>
  <div id="admin-search-users-results" class="laptop:flex laptop:flex-col laptop:gap-2">
  </div>
  <div id="loading-icon" class="my-6">
    <img class="w-12 h-12 mx-auto" src="{{url('/assets/loading-icon.gif')}}" alt="Loading...">
  </div>
</div>
@endsection