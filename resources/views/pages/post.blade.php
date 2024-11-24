@extends('layouts.app')

@section('content')
<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-[42rem] px-10 py-12 border-x border-gray-700">
        <div id="display-section">
            <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
            <div class="flex flex-wrap mt-5 gap-2">
                @foreach ($post->tags as $tag)
                    <span class="text-md text-gray-400 font-medium lowercase bg-input px-3  rounded-md">#{{ $tag->name }}</span>
                @endforeach
            </div>
            <div class="mt-5 text-sm text-gray-400">
                {{ $post->created_at->diffForHumans() }} • By {{ $post->author->username }}
            </div>
            <div class="mt-10">
            {{ $post->content }}
            </div>
            
            @include('partials.bar-post', ['post' => $post])

            <div class="mt-10 flex items-center">
                <input type="text" class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl" placeholder="Share your thoughts">
                <button class="-ml-20 border border-solid border-gray-700 px-5 py-2 rounded-xl ">Post</button>
            </div>
        </div>

        <div id="edit-section" class="hidden">
            <form id="editForm" method="POST" action="{{ route('news.update', $post->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" 
                        class="mt-1 block w-full p-3 border border-gray-700 bg-input rounded-xl outline-none">
                </div>
                <div class="mb-5">
                    <label for="content" class="block text-sm font-medium text-gray-300">Content</label>
                    <textarea name="content" id="content" rows="5"
                        class="mt-1 block w-full p-3 border border-gray-700 bg-input rounded-xl outline-none">{{ $post->content }}</textarea>
                </div>

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

                <input class="hidden" name="tags" id="tagsInput">
            </form>

            @include('partials.bar-post', ['post' => $post])

            <div class="mt-10 flex items-center">
                <input type="text" class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl" placeholder="Share your thoughts">
                <button class="-ml-20 border border-solid border-gray-700 px-5 py-2 rounded-xl ">Post</button>
            </div>
        </div>
    </section>
    <section class="hidden laptop:flex laptop:flex-col laptop:border-r laptop:p-4 laptop:border-gray-700 laptop:w-[21rem]">
        @if (Auth::check() && ((Auth::user()->id == $post->author_id) || Auth::user()->is_admin))
            <button id="edit-button" onclick="toggleEdit()" class="border border-solid text-black bg-white font-bold px-3 py-2 mt-2 rounded-xl">
                Edit
            </button>

            <div id="save-cancel-buttons" class="hidden flex justify-between gap-2 mt-2">
                <button id="saveButton" type="submit" form="editForm" class="border border-solid text-black bg-white font-bold px-3 py-2 rounded-xl w-1/2">
                    Save
                </button>
                <button type="button" onclick="toggleEdit()" class="border border-solid text-gray-700 bg-background text-white font-bold px-3 py-2 rounded-xl w-1/2">
                    Cancel
                </button>
            </div>
        @endif

        @if (Auth::check() && (Auth::user()->id != $post->author_id))
        <div class="flex items-center border border-gray-700 rounded-xl px-5 py-4 mt-8">
            <img src="{{ $post->author->profile_picture }}" alt="Profile Picture" class="w-12 h-12 rounded-full">

            <div class="ml-4">
                <p class="font-bold text-white">{{ $post->author->public_name }}</p>
                <p class="text-sm text-gray-500">{{ '@' . $post->author->username }}</p>
            </div>

            <button class="ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none">
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
