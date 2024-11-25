@extends('layouts.app')

@section('content')
<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-[42rem] px-10 py-12 border-x border-gray-700">
        <div id="display-section">
            <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
            <div class="flex flex-wrap mt-5 gap-2">
                @foreach ($post->tags as $tag)
                    <span class="text-md text-gray-400 font-medium lowercase bg-input px-3 rounded-md">#{{ $tag->name }}</span>
                @endforeach
            </div>
            @if (Auth::check())
                <div class="mt-5 text-sm text-gray-400">
                    {{ $post->created_at->diffForHumans() }} • By {{ $post->author->username }}
                </div>
            @endif
            
            <img src="{{ $post->title_image_path }}" alt="" class="rounded-xl mt-3">

            <div class="mt-10">
                {{ $post->content }}
            </div>
            
            @if (Auth::check())
                @include('partials.bar-post', ['post' => $post])
            
                <div class="mt-10 flex items-center">
                    <input type="text" class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl" placeholder="Share your thoughts">
                    <button class="-ml-20 border border-solid border-gray-700 px-5 py-2 rounded-xl ">Post</button>
                </div>
            @endif
        </div>

        <div id="edit-section" class="hidden">
            <form id="editForm" method="POST" action="{{ route('news.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" 
                        class="mt-1 block w-full p-3 border border-gray-700 bg-input rounded-xl outline-none">
                </div>

                <p class="block text-sm font-medium text-gray-300">Title Image</p>
                <div class="flex mt-4 mb-5" id="edit-image">
                    <button class="rounded flex justify-center m-5" id="personalizedFileInput" title="Click to upload new Image">
                        <img class="rounded-full w-48 h-48 object-cover border-2 border-white" src="{{$post->title_image_path}}" alt="Current Title Image">
                    </button>
                    <button class="hidden bg-input rounded-3xl px-6 py-8 w-40 min-h-28" id="buttonAddImage" title="Click to upload new Image">
                        Upload Post Title Image
                    </button>
                    <button id="deleteThumbnail" class="self-start">
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

                <div class="mb-5">
                    <label for="content" class="block text-sm font-medium text-gray-300">Content</label>
                    <textarea name="content" id="content" rows="5"
                        class="mt-1 block w-full p-3 border border-gray-700 bg-input rounded-xl outline-none">{{ $post->content }}</textarea>
                </div>

                <p class="block text-sm font-medium text-gray-300">Posts' Tag</p>

                <div class="flex flex-wrap items-center mt-5 gap-2" id="selectedTags">
                    <button id="toggleTagSelector" type="button" class="order-last ml-2 text-lg text-black bg-white rounded-xl px-3 font-medium hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50">+</button>
                </div>
                
                <div class='flex gap-2' id="tagSelectorContainer" style="display: none;">
                    <select class="bg-input rounded-2xl mt-3 p-2 w-40" id="tagSelector">
                        <option selected disabled></option>
                        @foreach ($availableTags as $tag)
                            <option value="{{ $tag['name'] }}">{{ $tag['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <p class="block text-sm font-medium text-gray-300 mt-5">Post's visibility</p>
                <div class="mt-4">
                    <!-- -- code copied from https://tailgrids.com/components/toggle-switch -->
                    <label for="toggleTwo" title="Make post vidible only for followers."
                        class="flex items-center cursor-pointer select-none text-dark dark:text-white gap-2 text-sm">
                        <div class="relative">
                            <input
                                type="checkbox"
                                id="toggleTwo"
                                class="peer sr-only"
                                {{$post->for_followers ? 'checked' : ''}}/>
                            <div class="block h-8 rounded-full dark:bg-dark-2 bg-input w-14"></div>
                            <div class="absolute w-6 h-6 transition bg-white rounded-full dot dark:bg-dark-4 left-1 top-1 peer-checked:translate-x-full peer-checked:bg-purple-900"></div>
                        </div>
                        Followers only
                    </label>
                </div>
                {{-- <p>{{dd($post->for_followers);}}</p> --}}
                <input class="hidden" name="tags" id="tagsInput">
                <input class="hidden" type="text" id="hiddenToggle" name="for_followers" value='{{$post->for_followers ? 'true' : 'false'}}'>
            </form>

            {{-- @include('partials.bar-post', ['post' => $post])

            <div class="mt-10 flex items-center">
                <input type="text" class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl" placeholder="Share your thoughts">
                <button class="-ml-20 border border-solid border-gray-700 px-5 py-2 rounded-xl ">Post</button>
            </div> --}}
        </div>
    </section>
    <section class="hidden laptop:flex laptop:flex-col laptop:border-r laptop:p-4 laptop:border-gray-700 laptop:w-[21rem]">
        
        <div class="flex gap-2" id="edit-button">
            @can('update', $post)
            <div class="flex-1">
                <button onclick="toggleEdit()" class="border border-solid text-black bg-white font-bold px-3 py-2 mt-2 rounded-xl w-full">
                    Edit
                </button>
            </div>
            @endcan
            @can('delete', $post)
            <div class="flex-1">
                <form method="POST" action="/news/{{ $post->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="border border-solid text-black bg-white font-bold px-3 py-2 mt-2 rounded-xl w-full" type="submit">Delete post</button>
                </form>
            </div>
            @endcan
        </div>
        
        @can('update', $post)
            <div id="save-cancel-buttons" class="hidden flex justify-between gap-2 mt-2">
                <button id="saveButton" type="submit" form="editForm" class="border border-solid text-black bg-white font-bold px-3 py-2 rounded-xl w-1/2">
                    Save
                </button>
                <button type="button" onclick="toggleEdit()" class="border border-solid bg-background text-white font-bold px-3 py-2 rounded-xl w-1/2">
                    Cancel
                </button>
            </div>
        @endcan

        @if (Auth::check())
            <p class="mt-4 font-bold">Post's Author</p>
            <div class="flex items-center border border-gray-700 rounded-xl px-5 py-4 mt-4">
                <img src="{{ $post->author->profile_image_path }}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">
                
                <a href="{{route('user.posts', ['user' => $post->author->id])}}">
                    <div class="ml-4">
                        <p class="font-bold text-white">{{ $post->author->public_name }}</p>
                        <p class="text-sm text-gray-500">{{ '@' . $post->author->username }}</p>
                    </div>
                </a>

                <button class="hidden ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none">
                    Subscribe
                </button>
            </div>
        @endif
    </section>
</section>

<script>
    const tags = @json($post->tags->pluck('name'));
</script>
    
@endsection
