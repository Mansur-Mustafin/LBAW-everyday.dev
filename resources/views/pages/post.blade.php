@extends('layouts.body.default')

@section('content')

@include('partials.success-popup')

<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-[42rem] px-10 py-12 border-x border-gray-700">
        <div id="display-section">
            <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
            <div class="flex flex-wrap mt-5 gap-2" id="tags-section" data-url="{{url('')}}">
                @foreach ($post->tags as $tag)
                    <div class="text-md text-gray-400 font-medium lowercase bg-input px-3 rounded-md flex gap-2">
                        #{{ $tag->name }}
                        @if(Auth::check())
                            <div id="{{$tag->id}}-data" class="hidden" data-isfollowed={{Auth::user()->tags->contains($tag)}}>
                            </div>
                            <a href="" id="{{$tag->id}}-unfollow"
                                class="{{Auth::user()->tags->contains($tag) ? '' : 'hidden'}}">-</a>
                            <a href="" id="{{$tag->id}}-follow"
                                class="{{Auth::user()->tags->contains($tag) ? 'hidden' : ''}}">+</a>
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

            <img src="{{ $post->titleImage->url }}" alt="" class="rounded-xl mt-3 w-full h-80 object-cover">
            @can('view', $post)
                <div class="mt-10 prose break-words">
                    {!! $post->content !!}
                </div>
            @endcan


            @if (Auth::check())
                @include('partials.bar-post', ['post' => $post])
            @endif

            @can('view', $post)
                @if (Auth::check())
                    <form class="mt-10 flex items-center" id="commentForm" data-auth="{{Auth::user() && Auth::user()->id}}">
                        <input type="text" data-post_id="{{ $post->id }}" data-thread="{{ $thread }}"
                            class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl hover:border-white hover:border-opacity-70"
                            placeholder="Share your thoughts" id="commentInput" />
                        <button class="-ml-20 px-5 py-2 rounded-xl bg-purple-900" type="submit">Post</button>
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
                            @include('partials.comment', ['comment' => $comment, 'level' => 0, 'post' => $post, 'thread' => $thread])
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
                    <svg class="w-32 h-32" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="507.45276"
                        height="499.98424" viewBox="50 0 207.45276 499.98424"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path id="ad903c08-5677-4dbe-a9c7-05a0eb46801f-1494" data-name="Path 461"
                            d="M252.30849,663.16553a22.728,22.728,0,0,0,21.947-3.866c7.687-6.452,10.1-17.081,12.058-26.924l5.8-29.112-12.143,8.362c-8.733,6.013-17.662,12.219-23.709,20.929s-8.686,20.6-3.828,30.024"
                            transform="translate(-196.27362 -200.00788)" fill="#e6e6e6" />
                        <path id="a94887ac-0642-4b28-b311-c351a0f7f12b-1495" data-name="Path 462"
                            d="M253.34651,698.41151c-1.229-8.953-2.493-18.02-1.631-27.069.766-8.036,3.217-15.885,8.209-22.321a37.13141,37.13141,0,0,1,9.527-8.633c.953-.6,1.829.909.881,1.507a35.29989,35.29989,0,0,0-13.963,16.847c-3.04,7.732-3.528,16.161-3,24.374.317,4.967.988,9.9,1.665,14.83a.9.9,0,0,1-.61,1.074.878.878,0,0,1-1.074-.61Z"
                            transform="translate(-196.27362 -200.00788)" fill="#f2f2f2" />
                        <path
                            d="M496.87431,505.52556a6.9408,6.9408,0,0,1-2.85071.67077l-91.60708,2.51425a14.3796,14.3796,0,0,1-.62506-28.75241l91.60729-2.51381a7.00744,7.00744,0,0,1,7.15064,6.8456l.32069,14.75586a7.01658,7.01658,0,0,1-3.99577,6.47974Z"
                            transform="translate(-196.27362 -200.00788)" fill="#6c63ff" />
                        <path
                            d="M379.332,698.59808H364.57245a7.00786,7.00786,0,0,1-7-7V568.58392a7.00785,7.00785,0,0,1,7-7H379.332a7.00786,7.00786,0,0,1,7,7V691.59808A7.00787,7.00787,0,0,1,379.332,698.59808Z"
                            transform="translate(-196.27362 -200.00788)" fill="#6c63ff" />
                        <path
                            d="M418.52435,698.59808H403.76459a7.00786,7.00786,0,0,1-7-7V568.58392a7.00785,7.00785,0,0,1,7-7h14.75976a7.00786,7.00786,0,0,1,7,7V691.59808A7.00787,7.00787,0,0,1,418.52435,698.59808Z"
                            transform="translate(-196.27362 -200.00788)" fill="#6c63ff" />
                        <circle cx="196.71571" cy="182.69717" r="51" fill="#6c63ff" />
                        <path
                            d="M410.30072,605.205H373.61127a43.27708,43.27708,0,0,1-37.56043-65.05664l51.30933-88.87012a6.5,6.5,0,0,1,11.2583,0l50.27612,87.08057A44.56442,44.56442,0,0,1,410.30072,605.205Z"
                            transform="translate(-196.27362 -200.00788)" fill="#2f2e41" />
                        <path
                            d="M405.02686,404.114c3.30591-.0918,7.42029-.20655,10.59-2.522a8.13274,8.13274,0,0,0,3.20007-6.07275,5.47084,5.47084,0,0,0-1.86035-4.49315c-1.65552-1.39894-4.073-1.72706-6.67823-.96144l2.69922-19.72558-1.98144-.27149-3.17322,23.18994,1.65466-.75928c1.91834-.87988,4.55164-1.32763,6.188.05518a3.51514,3.51514,0,0,1,1.15271,2.89551,6.14686,6.14686,0,0,1-2.38122,4.52783c-2.46668,1.80176-5.74622,2.03418-9.46582,2.13818Z"
                            transform="translate(-196.27362 -200.00788)" fill="#2f2e41" />
                        <rect x="226.50312" y="172.03238" width="10.77161" height="2" fill="#2f2e41" />
                        <rect x="192.50312" y="172.03238" width="10.77161" height="2" fill="#2f2e41" />
                        <path
                            d="M380.99359,593.79839a6.94088,6.94088,0,0,1-.67077-2.85072l-2.51425-91.60708a14.3796,14.3796,0,0,1,28.75241-.62506l2.51381,91.60729a7.00744,7.00744,0,0,1-6.8456,7.15064l-14.75586.32069a7.01655,7.01655,0,0,1-6.47974-3.99576Z"
                            transform="translate(-196.27362 -200.00788)" fill="#6c63ff" />
                        <path
                            d="M388.25747,345.00549c6.19637,8.10336,16.033,13.53931,26.42938,12.25223,9.90031-1.22567,18.06785-8.12619,20.117-18.0055a29.66978,29.66978,0,0,0-7.79665-26.1905c-7.00748-7.37032-17.03634-11.335-26.96311-12.69456-18.80446-2.57537-38.1172,4.04852-52.33518,16.4023a64.1102,64.1102,0,0,0-16.69251,22.37513,62.72346,62.72346,0,0,0-5.175,27.07767c.54633,18.375,8.595,36.71479,22.48271,48.90083a63.37666,63.37666,0,0,0,5.40808,4.23578c1.58387,1.11112,3.08464-1.48868,1.51415-2.59042-14.222-9.977-23.29362-26.21093-25.78338-43.26844a59.92391,59.92391,0,0,1,14.05278-48.33971c11.48411-13.058,28.32271-21.54529,45.7628-22.30575,17.54894-.76521,39.47915,7.06943,42.7631,26.60435,1.47191,8.7558-1.801,17.95926-9.82454,22.3428-8.59053,4.69326-19.12416,2.76181-26.50661-3.29945a30.448,30.448,0,0,1-4.86258-5.01092c-1.157-1.51313-3.76387-.02044-2.59041,1.51416Z"
                            transform="translate(-196.27362 -200.00788)" fill="#2f2e41" />
                        <path
                            d="M547.86351,482.19293c-17.96014,0-32.5719-15.52155-32.5719-34.60067,0-19.07858,14.61176-34.60014,32.5719-34.60014s32.5719,15.52156,32.5719,34.60014C580.43541,466.67138,565.82365,482.19293,547.86351,482.19293Zm0-60.4582c-13.13954,0-23.82929,11.59955-23.82929,25.85753s10.68975,25.85806,23.82929,25.85806,23.82928-11.60008,23.82928-25.85806S561.00305,421.73473,547.86351,421.73473Z"
                            transform="translate(-196.27362 -200.00788)" fill="#6c63ff" />
                        <path
                            d="M578.70786,542.49212h-61.6887a20.54138,20.54138,0,0,1-20.51852-20.51826V461.46391a14.06356,14.06356,0,0,1,14.04747-14.04774h74.6308a14.06356,14.06356,0,0,1,14.04747,14.04774v60.50995A20.54138,20.54138,0,0,1,578.70786,542.49212Z"
                            transform="translate(-196.27362 -200.00788)" fill="#3f3d56" />
                        <path
                            d="M559.88461,481.84022a12.0211,12.0211,0,1,0-17.48524,10.69829v18.808h10.92827v-18.808A12.01088,12.01088,0,0,0,559.88461,481.84022Z"
                            transform="translate(-196.27362 -200.00788)" fill="#fff" />
                        <path d="M578.27362,699.99212h-381a1,1,0,0,1,0-2h381a1,1,0,0,1,0,2Z"
                            transform="translate(-196.27362 -200.00788)" fill="#3f3d56" />
                    </svg>
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
                    <input type="text" name="title" id="title" value="{{ $post->title }}" placeholder="Post Title*"
                        class="mt-1 block w-full p-3 border border-gray-700 bg-input rounded-xl outline-none">
                </div>

                <div class="mb-5">
                    <label for="content" class="block text-sm font-medium text-gray-300">Content</label>

                    <div id="editor-edit-container" class="text-white rounded-xl bg-input !border-none">
                        {!! $post->content !!}
                    </div>
                    <input class="hidden" id="edit-content-input" name="content">
                    <input class="hidden" id="content-images-edit" name="content_images">
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

                <p class="block text-sm font-medium text-gray-300 mt-5 mb-3">Post's visibility</p>
                <div class="toggleTwo" data-name="Followers only"
                    data-initialvalue="{{ $post->for_followers ? 'true' : 'false'}}">
                    <input class="hidden hiddenToggle" type="text" name="for_followers"
                        value='{{$post->for_followers ? 'true' : 'false'}}'>
                </div>
                <input class="hidden" name="tags" id="tagsInput">
            </form>
        </div>

    </section>
    <section
        class="hidden laptop:flex laptop:flex-col laptop:border-r laptop:p-4 laptop:border-gray-700 laptop:w-[21rem]">

        <div class="flex flex-col gap-1" id="edit-button">
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
            @if (Auth::check() && Auth::user()->isAdmin())
                @if(!$post->is_omitted)
                    <div class="flex-1">
                        <form method="POST" action="/news/{{ $post->id }}/omit">
                            @csrf
                            @method('PUT')
                            <button class="border border-solid text-black bg-white font-bold px-3 py-2 mt-2 rounded-xl w-full"
                                type="submit">Omit post</button>
                        </form>
                    </div>
                @else
                    <div class="flex-1">
                        <form method="POST" action="/news/{{ $post->id }}/unomit">
                            @csrf
                            @method('PUT')
                            <button class="border border-solid text-black bg-white font-bold px-3 py-2 mt-2 rounded-xl w-full"
                                type="submit">Un-Omit post</button>
                        </form>
                    </div>
                @endif
            @endif
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
                    <button id="follow-button-refresh"
                        class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none"
                        data-user-id="{{ $post->author->id }}" data-action="follow">Follow</button>
                @endcan
                @can('unfollow', $post->author)
                    <button id="unfollow-button-refresh"
                        class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none"
                        data-user-id="{{ $post->author->id }}" data-action="unfollow">Unfollow</button>
                @endcan
            </div>
            @if ($post->for_followers)
                <div class="flex mt-4">
                    <span class="bg-[#A480CF] text-gray-800 px-3 py-1 rounded-lg text-sm">Followers Only</span>
                </div>
            @endif
        @endif
    </section>
</section>

<script>
    const tags = @json($post->tags->pluck('name'));
</script>

@endsection