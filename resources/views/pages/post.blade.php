@extends('layouts.body.default')

@section('content')

@include('partials.success-popup')

<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-[42rem] px-10 py-12 border-x border-gray-700">
        <div id="display-section">
            <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
            <div class="flex flex-wrap mt-5 gap-2">
                @foreach ($post->tags as $tag)
                    <span
                        class="text-md text-gray-400 font-medium lowercase bg-input px-3 rounded-md">#{{ $tag->name }}</span>
                @endforeach
            </div>
            @if (Auth::check())
                @if ($post->changed_at)
                    <div class="mt-5 text-sm text-gray-400">
                        Edited {{ $post->changed_at->diffForHumans() }} • By {{ $post->author->username }}
                    </div>
                @else
                    <div class="mt-5 text-sm text-gray-400">
                        Posted {{ $post->created_at->diffForHumans() }} • By {{ $post->author->username }}
                    </div>
                @endif
            @endif

            <img src="{{ $post->titleImage->url }}" alt="" class="rounded-xl mt-3 w-full h-80 object-cover">

            <div class="mt-10">
                {{ $post->content }}
            </div>

            @if (Auth::check())
                @include('partials.bar-post', ['post' => $post])
            @endif
        </div>

        <div id="edit-section" class="hidden">
            <form id="editForm" method="POST" action="{{ route('news.update', $post->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p class="block text-sm font-medium text-gray-300">Title Image</p>
                <div class="flex mt-4 mb-5" id="edit-image">
                    <button class="rounded flex justify-center m-5" id="personalizedFileInput"
                        title="Click to upload new Image">
                        <img class="rounded-full w-48 h-48 object-cover border-2 border-white"
                            src="{{$post->titleImage->url}}" alt="Current Title Image">
                    </button>
                    <button class="hidden bg-input rounded-3xl px-6 py-8 w-40 min-h-28" id="buttonAddImage"
                        title="Click to upload new Image">
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
                    <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}"
                        class="mt-1 block w-full p-3 border border-gray-700 bg-input rounded-xl outline-none">
                </div>

                <div class="mb-5">
                    <label for="content" class="block text-sm font-medium text-gray-300">Content</label>
                    <textarea name="content" id="content" rows="5"
                        class="mt-1 block w-full p-3 border border-gray-700 bg-input rounded-xl outline-none">{{ $post->content }}</textarea>
                </div>

                <p class="block text-sm font-medium text-gray-300">Posts' Tag</p>

                <div class="flex flex-wrap items-center mt-5 gap-2" id="selectedTags">
                    <button id="toggleTagSelector" type="button"
                        class="order-last ml-2 text-lg text-black bg-white rounded-xl px-3 font-medium hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50">+</button>
                    @foreach ($post->tags as $tag)
                        <div data-tag="{{ $tag->name }}" class="relative inline-block mr-2">
                            <span
                                class="text-md text-input font-medium lowercase bg-white px-2 py-1 rounded-md">#{{ strtolower($tag->name) }}</span>
                            <button type="button"
                                class="absolute top-0 right-0 transform -translate-y-1/2 translate-x-1/2 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs hover:bg-red-600"
                                data-tag="{{ $tag->name }}">
                                ×
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class='flex gap-2' id="tagSelectorContainer" style="display: none;">
                    <select class="bg-input rounded-2xl mt-3 p-2 w-40" id="tagSelector">
                        <option selected disabled></option>
                        @foreach ($availableTags as $tag)
                            <option value="{{ $tag['name'] }}">{{ $tag['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <p class="block text-sm font-medium text-gray-300 mt-5">Post's visibility</p> --}}
                <div class="toggleTwo" data-name="Followers only" data-initialvalue="{{ $post->for_followers ? 'true' : 'false'}}">
                    <input class="hidden hiddenToggle" type="text" name="for_followers"
                        value='{{$post->for_followers ? 'true' : 'false'}}'>
                </div>
                <input class="hidden" name="tags" id="tagsInput">
                
            </form>

            {{-- @include('partials.bar-post', ['post' => $post])

            <div class="mt-10 flex items-center">
                <input type="text"
                    class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl"
                    placeholder="Share your thoughts">
                <button class="-ml-20 border border-solid border-gray-700 px-5 py-2 rounded-xl ">Post</button>
            </div> --}}
        </div>
        <form class="mt-10 flex items-center" id="commentForm" data-auth="{{Auth::user() && Auth::user()->id}}">
            <input type="text" data-post_id="{{ $post->id }}" data-thread="{{ $thread }}"
                class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl hover:border-white hover:border-opacity-70"
                placeholder="Share your thoughts" id="commentInput" />
            <button class="-ml-20 px-5 py-2 rounded-xl bg-purple-900" type="submit">Post</button>
        </form>

        <section class="mt-10">

            @if ($thread == 'single')
                <div class="flex justify-between mb-5 items-center">
                    <h1 class="pl-1 pr-3 text-sm">Single thread discussion
                    </h1>
                    <hr class="flex-grow opacity-20 text-gray-700">
                    </hr>
                    <a href="{{ url('news/' . $post->id) }}" class="pr-1 pl-3 text-sm hover:underline">See full
                        discussion</a>
                </div>

            @endif

            <div class="flex flex-col gap-3" id="comment-section">

                @forelse ($comments->where('parent_comment_id', null) as $comment)
                    @include('partials.comment', ['comment' => $comment, 'level' => 0, 'post' => $post, 'thread' => $thread])
                @empty
                    <div class="text-gray-400" id="no-comments">
                        No comments yet. Be the first to comment!
                    </div>
                @endforelse
            </div>
        </section>
    </section>
    <section
        class="hidden laptop:flex laptop:flex-col laptop:border-r laptop:p-4 laptop:border-gray-700 laptop:w-[21rem]">

        <div class="flex gap-2" id="edit-button">
            @can('update', $post)
                <div class="flex-1">
                    <button onclick="toggleEdit()"
                        class="border border-solid text-black bg-white font-bold px-3 py-2 mt-2 rounded-xl w-full">
                        Edit
                    </button>
                </div>
            @endcan
            @can('delete', $post)
                <div class="flex-1">
                    <form method="POST" action="/news/{{ $post->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="border border-solid text-black bg-white font-bold px-3 py-2 mt-2 rounded-xl w-full"
                            type="submit">Delete post</button>
                    </form>
                </div>
            @endcan
        </div>

        @can('update', $post)
            <div id="save-cancel-buttons" class="hidden flex justify-between gap-2 mt-2">
                <button id="saveButton" type="submit" form="editForm"
                    class="border border-solid text-black bg-white font-bold px-3 py-2 rounded-xl w-1/2">
                    Save
                </button>
                <button type="button" onclick="toggleEdit()"
                    class="border border-solid bg-background text-white font-bold px-3 py-2 rounded-xl w-1/2">
                    Cancel
                </button>
            </div>
        @endcan

        @if (Auth::check())
            <p class="mt-4 font-bold">Post's Author</p>
            <div class="flex items-center border border-gray-700 rounded-xl px-5 py-4 mt-4">
                <img src="{{ $post->author->profileImage->url }}" alt="Profile Picture"
                    class="w-12 h-12 rounded-full object-cover">

                <a href="{{route('user.posts', ['user' => $post->author->id])}}">
                    <div class="ml-4">
                        <p class="font-bold text-white">{{ $post->author->public_name }}</p>
                        <p class="text-sm text-gray-500">{{ '@' . $post->author->username }}</p>
                    </div>
                </a>
                @can('follow', $post->author)
                    <button
                        class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none"
                        data-user-id="{{ $post->author->id }}" data-action="follow">Follow</button>
                @endcan
                @can('unfollow', $post->author)
                    <button
                        class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none"
                        data-user-id="{{ $post->author->id }}" data-action="unfollow">Unfollow</button>
                @endcan
            </div>
            {{-- @if ($post->for_followers)
            <div class="flex mt-4">
                <p class="bg-red-400 text-gray-800 px-3 py-1 ml-2 rounded-full text-sm ">Followers only</p>
            </div>
            @endif --}}
        @endif
    </section>
</section>

<script>
    const tags = @json($post->tags->pluck('name'));
</script>

@endsection