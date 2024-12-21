@extends('layouts.body.admin')

@section('content')

@include('partials.success-popup')

<div
  class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full p-5">
  <div class="flex gap-2 items-center mt-20 justify-between">
    <div class="flex flex-grow text-white bg-input rounded-2xl p-3 items-center">
      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28" fill="white" viewBox="0 0 30 30" class="mr-1">
        <path
          d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
        </path>
      </svg>
      <input data-url="{{ url('') }}" id="admin-search-bar" type="text"
        class="laptop:h-full outline-none rounded-t w-full text-md bg-input laptop:text-lg"
        placeholder="Type to search...">
    </div>

    @if ($show == 'users')
    <a href="{{url('admin/users/create')}}" id="create-user"
      class="text-white bg-purple rounded-xl text-md p-3 flex gap-1 items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-plus">
      <path d="M5 12h14" />
      <path d="M12 5v14" />
      </svg>
      <p class="hidden tablet:flex">Create user</p>
    </a>
  @endif

    @if ($show == 'tags')
    <a href="{{url('admin/tags/create')}}" id="create-tag"
      class="text-white bg-purple rounded-xl text-md p-3 flex gap-1 items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-plus">
      <path d="M5 12h14" />
      <path d="M12 5v14" />
      </svg>
      <p class="hidden tablet:flex">Create tag</p>
    </a>
  @endif
  </div>

  @if ($show == 'users')
    <div id="admin-search-users-results" class="flex flex-col gap-2 mt-5"></div>
  @endif

  @if($show == 'tags')
    <div id="admin-search-tags-results" class="flex flex-col gap-2 mt-5"></div>
  @endif



  @if($show == 'tag_proposals')
    <div id="admin-search-tag-proposals-results" class="laptop:flex laptop:flex-col gap-2 mt-2"></div>
  @endif

  @if($show == 'unblock_appeals')
    <div id="admin-search-unblock-appeals-results" class="laptop:flex laptop:flex-col gap-2 mt-2"></div>
  @endif

  @if($show == 'omitted_posts')
    <div id="admin-search-omitted-posts-results" class="laptop:flex laptop:flex-col gap-2 mt-2"></div>
  @endif

  @if($show == 'omitted_comments')
    <div id="admin-search-omitted-comments-results" class="laptop:flex laptop:flex-col gap-2 mt-2"></div>
  @endif

  <div id="loading-icon" class="my-6">
    <img class="w-12 h-12 mx-auto" src="{{url('/assets/loading-icon.gif')}}" alt="Loading...">
  </div>
</div>

<div id="confirm-popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
  <div class="bg-input p-6 rounded-lg w-96 text-black">
    <h3 class="text-lg font-semibold text-white mb-4">Are you sure?</h3>
    <p class="text-gray-300 mb-6">This action cannot be undone.</p>
    <div class="flex justify-end gap-2">
      <a id="cancel-button" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400" href="">Cancel</a>
      <a id="confirm-button" class="px-4 py-2 bg-purple-900 text-white rounded-lg hover:bg-purple-700"
        href="">Confirm</a>
    </div>
  </div>
</div>
@endsection