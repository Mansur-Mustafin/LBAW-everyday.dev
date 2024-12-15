@extends('layouts.body.admin')

@section('content')

@include('partials.success-popup')

<div class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full laptop:p-5">
  <div class="flex text-black bg-white rounded p-2 mt-20">
    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" viewBox="0 0 30 30">
      <path
        d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
      </path>
    </svg>
    <input data-url="{{ url('') }}" id="admin-search-bar" type="text"
      class="laptop:h-full laptop:p-2 outline-none rounded-t w-full text-lg laptop:text-xl">
  </div>

  @if ($show == 'users')
    <a href="{{url('admin/users/create')}}" id="create-user"
      class="flex flex-col border border-gray-700 text-white bg-purple-900 text-2xl items-center justify-center p-2 my-2">
      <p class="w-fit">
        Create new user
      </p>
    </a>
    <div id="admin-search-users-results" class="laptop:flex laptop:flex-col gap-2"></div>
  @endif

  @if($show == 'tags')
    <a href="{{url('admin/tags/create')}}" id="create-tag"
      class="flex flex-col border border-gray-700 text-white bg-purple-900 text-2xl items-center justify-center p-2 my-2">
      <p class="w-fit">
        Create new Tag
      </p>
    </a>
    <div id="admin-search-tags-results" class="laptop:flex laptop:flex-col gap-2"></div>
  @endif

  @if($show == 'tag_proposals')
    <div id="admin-search-tag-proposals-results" class="laptop:flex laptop:flex-col gap-2 mt-2"></div>
  @endif

  @if($show == 'unblock_appeals')
    <div id="admin-search-unblock-appeals-results" class="laptop:flex laptop:flex-col gap-2 mt-2"></div>
  @endif

  <div id="loading-icon" class="my-6">
    <img class="w-12 h-12 mx-auto" src="{{url('/assets/loading-icon.gif')}}" alt="Loading...">
  </div>
</div>

@endsection