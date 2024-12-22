@extends('layouts.body.admin')

@section('title', 'Administrator Dashboard')

@section('content')

@include('partials.success-popup')

<div
  class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full p-5">
  <div class="flex gap-2 items-center justify-between">
    <div class="flex flex-grow text-white bg-input rounded-2xl p-3 items-center">
      @include('partials.svg.search')
      <input data-url="{{ url('') }}" id="admin-search-bar" type="text"
        class="laptop:h-full outline-none rounded-t w-full text-md bg-input" placeholder="Type to search...">
    </div>

    @if ($show == 'users')
    <a href="{{url('admin/users/create')}}" id="create-user"
      class="text-white bg-purple rounded-xl text-md p-3 flex gap-1 items-center">
      @include('partials.svg.admin.create')
      <p class="hidden tablet:flex">Create user</p>
    </a>
  @endif

    @if ($show == 'tags')
    <a href="{{url('admin/tags/create')}}" id="create-tag"
      class="text-white bg-purple rounded-xl text-md p-3 flex gap-1 items-center">
      @include('partials.svg.admin.create')
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
    <div id="admin-search-tag-proposals-results" class="flex flex-col gap-2 mt-5"></div>
  @endif

  @if($show == 'unblock_appeals')
    <div id="admin-search-unblock-appeals-results" class="flex flex-col gap-2 mt-5"></div>
  @endif

  @if($show == 'omitted_posts')
    <div id="admin-search-omitted-posts-results" class="flex flex-col gap-2 mt-5"></div>
  @endif

  @if($show == 'omitted_comments')
    <div id="admin-search-omitted-comments-results" class="flex flex-col gap-2 mt-5"></div>
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