@extends('layouts.body.default')

@section('title','News Post')

@section('content')

@include('partials.success-popup')

<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-2/3 px-10 py-12 laptop:border-x border-gray-700">
        <div id="display-section">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl break-all laptop:break-normal max-w-40 tablet:max-w-96 laptop:max-w-full font-bold">
                    {{ $post->title }}
                </h1>
                @if(Auth::check())
                <div class="relative laptop:hidden" title="post options">
                    <button class="hover:bg-input p-2 rounded-xl post-options">
                        @include('partials.svg.filter')
                    </button>
                    @include('partials.post.post-options')
                </div>
                @endif
            </div>
            <div class="flex flex-wrap mt-5 gap-2" id="tags-section" data-url="{{url('')}}">
                @foreach ($post->tags as $tag)
                    <div class="text-md text-gray-400 font-medium lowercase bg-input px-3 rounded-md flex gap-2">
                        #{{ $tag->name }}
                        @if(Auth::check())
                            <div id="{{$tag->id}}-data" class="hidden" data-isfollowed={{Auth::user()->tags->contains($tag)}}>
                            </div>
                            <a href="" id="{{$tag->id}}-unfollow"
                                class="{{Auth::user()->tags->contains($tag) ? '' : 'hidden'}}" title="unfollow tag">-</a>
                            <a href="" id="{{$tag->id}}-follow"
                                class="{{Auth::user()->tags->contains($tag) ? 'hidden' : ''}}" title="follow tag">+</a>
                        @endif
                    </div>
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

            <img src="{{ $post->titleImage->url }}" alt="Post Title" class="rounded-xl mt-3 w-full h-80 object-cover">
            @can('view', $post)
                <div class="mt-10 prose break-words">
                    {!! $post->content !!}
                </div>
            @endcan


            @if (Auth::check())
                @include('partials.post.bar-post', ['post' => $post])
            @endif

            @can('view', $post)
                @if (Auth::check())
                    <form class="mt-10 flex items-center" id="commentForm" data-auth="{{Auth::user() && Auth::user()->id}}">
                        <label for="comment"></label>
                        <input type="text" id="commentInput" data-post_id="{{ $post->id }}" data-thread="{{ $thread }}"
                            class="outline-none py-4 pl-4 pr-20 w-full border border-solid border-gray-700 bg-input rounded-xl hover:border-white hover:border-opacity-70"
                            placeholder="Share your thoughts" id="commentInput" /> 
                        <button class="-ml-20 px-5 py-2 rounded-xl" type="submit">Post</button>
                    </form>
                @endif


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
                            @include('partials.comment.comment', ['comment' => $comment, 'level' => 0, 'post' => $post, 'thread' => $thread])
                        @empty
                            @if (Auth::check())
                                <div class="text-gray-400" id="no-comments">
                                    No comments yet. Be the first to comment!
                                </div>
                            @endif

                        @endforelse
                    </div>
                </section>
            @endcan
            @cannot('view', $post)
            <div class="mt-4 flex flex-row gap-4">
                <div>
                    @include('partials.svg.private-content')
                </div>
                <div class="self-end">
                    <p class="text-lg">The content is private</p>
                    <p class="text-gray-400 text-lg">Follow the author to see post's content.</p>
                </div>
            </div>
            @endcannot
        </div>

        <div id="edit-section" class="hidden">
            <form id="editForm" method="POST" action="{{ route('news.update', $post->id) }}"
                enctype="multipart/form-data" data-post_id="{{$post->id}}">
                @csrf
                @method('PUT')
                <p class="block text-sm font-medium text-gray-300">Title Image</p>
                <div class="flex mt-4 mb-5" id="edit-image">
                    <button class="rounded flex justify-center" id="personalizedFileInput"
                        title="Click to upload new Image">
                        <img class="rounded-full w-48 h-48 object-cover border-2 border-white"
                            src="{{$post->titleImage->url}}" alt="Current Title Image">
                    </button>
                    <button class="hidden bg-input rounded-3xl px-6 py-8 w-40 min-h-28" id="buttonAddImage"
                        title="Click to upload new Image">
                        Upload image
                    </button>
                    <button id="deleteThumbnail" class="self-start" title="delete image">
                        @include('partials.svg.circle-x')
                    </button>
                </div>
                <input class="hidden" type="file" id="realFileInput" name="image" accept=".png, .jpg, .jpeg, .gif">
                <input class="hidden" id="fileRemoved" name="remove_image" value="false">

                <div class="flex flex-col gap-2">
                    <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                    <input name="title" 
                        type="text"
                        id="title" 
                        class="rounded-2xl bg-input outline-none p-3 @error('title') border border-red-500 @else  @enderror" 
                        placeholder="Post title*"
                        value="{{ $post->title }}"
                        required
                        pattern=".*\S.*">
                    <span class="hidden ml-4 text-red-400 text-sm mb-2" id="title-error">
                        Title cannot be empty
                    </span>
                    @error('title')
                        <span class="ml-4 text-red-400 text-sm" id="title-server-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="my-5">
                    <label for="content" class="block text-sm font-medium text-gray-300">Content</label>

                    <div id="editor-edit-container" class="!text-white rounded-xl bg-input !border-none">
                        {!! $post->content !!}
                    </div>
                    <input class="hidden" id="edit-content-input" name="content">
                    <input class="hidden" id="content-images-edit" name="content_images">
                </div>

                <p class="block text-sm font-medium text-gray-300">Posts' Tag</p>

                <div class="flex flex-wrap items-center mt-5 gap-2" id="selectedTags">
                    <button id="toggleTagSelector" type="button" title="add tags"
                        class="order-last ml-2 text-lg text-black bg-white rounded-xl px-3 font-medium hover:text-purple-400 hover:bg-purple hover:bg-opacity-50">+</button>
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

                <p class="block text-sm font-medium text-gray-300 mt-5 mb-3">Post's visibility</p>
                <div class="toggleTwo" data-name="Followers only"
                    data-initialvalue="{{ $post->for_followers ? 'true' : 'false'}}">
                    <input class="hidden hiddenToggle" type="text" name="for_followers"
                        value='{{$post->for_followers ? 'true' : 'false'}}'>
                </div>

                @can('update', $post)
                    <div id="save-cancel-buttons" class="flex gap-2 mt-4 justify-end">
                        <button type="button" onclick="toggleEdit()"
                            class="border border-solid bg-white text-background font-bold px-3 py-2 rounded-xl">
                            Cancel
                        </button>
                        <button id="saveButton" type="submit" form="editForm"
                            class="border border-solid bg-white text-background font-bold px-3 py-2 rounded-xl">
                            Save
                        </button>
                    </div>
                @endcan

                <input class="hidden" name="tags" id="tagsInput">
            </form>
        </div>

    </section>
    <section
        class="hidden laptop:flex laptop:flex-col laptop:border-r laptop:p-4 laptop:border-gray-700 laptop:w-[21rem]">
        <div class="flex items-center justify-between">
            <div class="flex gap-2">
                @if ($post->for_followers)
                    <div class="flex">
                        <span class="bg-purple text-white px-3 py-1 rounded-lg text-sm">Followers Only</span>
                    </div>
                @endif
                <div class="flex">
                    <span id="omit-post-card" class="bg-purple text-white px-3 py-1 rounded-lg text-sm {{ $post->is_omitted ? '' : 'hidden' }}">Omitted</span>
                </div>
            </div>
            @if (Auth::check())
            <div class="relative self-end" title="post options">
                <button class="hover:bg-input p-2 rounded-xl post-options">
                    @include('partials.svg.filter')
                </button>
                @include('partials.post.post-options')
            </div>
            @endif
        </div>

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
                    <button id="follow-button-refresh"
                        class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple hover:bg-opacity-50 hover:border-none"
                        data-user-id="{{ $post->author->id }}" data-action="follow">Follow</button>
                @endcan
                @can('unfollow', $post->author)
                    <button id="unfollow-button-refresh"
                        class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple hover:bg-opacity-50 hover:border-none"
                        data-user-id="{{ $post->author->id }}" data-action="unfollow">Unfollow</button>
                @endcan
            </div>
        @endif
    </section>
</section>

<script>
    const tags = @json($post->tags->pluck('name'));
</script>

@endsection