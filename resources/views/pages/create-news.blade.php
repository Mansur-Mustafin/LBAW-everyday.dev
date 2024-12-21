@extends('layouts.body.default')

@section('content')

@include('partials.success-popup')

<section
    class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <form class="px-3 flex flex-col gap-4 mt-4" method="POST" action="{{ route('news') }}" enctype="multipart/form-data"
        id="createForm" novalidate>
        @csrf
        <label class="text-sm font-medium text-gray-300">Title Image</label>
        <div class="flex mt-4 mb-5" id="edit-image">
            <button class="hidden rounded flex justify-center m-5" id="personalizedFileInput"
                title="Click to upload new Image">
                <img class="rounded-full w-48 h-48 object-cover border-2 border-white" src="" alt="Current Title Image">
            </button>
            <button class="bg-input rounded-3xl px-6 py-8 w-40 min-h-28" id="buttonAddImage"
                title="Click to upload new Image">
                Upload Post Title Image
            </button>
            <button id="deleteThumbnail" class="self-start hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-circle-x">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m15 9-6 6" />
                    <path d="m9 9 6 6" />
                </svg>
            </button>
        </div>
        <input class="hidden" type="file" id="realFileInput" name="image">
        <input class="hidden" id="fileRemoved" name="remove_image" value="false">

        <div class="flex flex-col gap-2">
            <input name="title" 
                id="title" 
                class="rounded-2xl bg-input outline-none p-3 @error('title') border border-red-500 @else  @enderror" 
                placeholder="Post title*"
                value="{{ old('title') }}"
                required
                pattern=".*\S.*">
            <span class="hidden ml-4 text-red-400 text-sm" id="title-error">
                Title cannot be empty.
            </span>
            @error('title')
                <span class="ml-4 text-red-400 text-sm" id="title-server-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="flex flex-col">
            <label class="text-sm font-medium text-gray-300">Content</label>
            <div id="editor-create-container" class="!text-white rounded-xl bg-input !border-none"></div>
            <input type="hidden" value="{{old('content')}}" id="old-content">
            <input class="hidden" id="create-content-input" name="content">
            <input class="hidden" id="content-images-create" name="content_images">

            <div class="flex items-center justify-between mt-5">
                <div class='flex items-center gap-2'>
                    <select class="bg-input rounded-2xl p-3 w-40" id="tagSelector">
                        <option selected disabled></option>
                        @foreach ($tags as $tag)
                            <option value={{ $tag['name'] }}>{{ $tag['name'] }}</option>
                        @endforeach
                    </select>
                    <label class='hidden laptop:text-sm tablet:block'>Add tags to your post</label>
                </div>
                <div class="toggleTwo" data-name="Followers only" data-initialvalue="false">
                    <input class="hidden hiddenToggle" type="text" name="for_followers" value='false'>
                </div>
            </div>

        </div>
        <div id="selectedTags" class="flex gap-1 flex-wrap"></div>

        <input class="hidden" name="tags" id="tagsInput">
        <button id="post-button" class="text-input bg-white font-bold rounded-xl px-6 py-2 self-end" type="submit">
            Post
        </button>
    </form>
</section>
@endsection
