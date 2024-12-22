@php
    $level = $level ?? 0;
@endphp

@if ($level == 0)
    <div class="border border-solid border-gray-700 rounded-xl flex flex-col {{ $comment->is_omitted ? 'opacity-50' : '' }} " id="{{ 'comment-' . $comment->id }}"
        data-auth="{{ Auth::user() && Auth::user()->id }}"
        data-replies="{{ count($comment->replies) == 0 ? 'false' : 'true' }}">
        <div class="{{ count($comment->replies) == 0 ? '' : 'border-b border-solid border-gray-700' }} rounded-xl p-4">
            <div class="text-sm text-gray-400 flex justify-between items-start">
                @if (Auth::user())
                    <div class="flex gap-2 flex-grow">
                        <img src="{{ $comment->author->profileImage->url }}" class="max-w-8 max-h-8 rounded-full" alt="Profile Image">
                        <div class="flex flex-col">
                            <h2 class="text-white text-sm font-semibold">{{ $comment->author->public_name }}</h2>
                            <h3 class="text-xs text-gray-500">{{ '@' . $comment->author->username }} ·
                                {{ $comment->created_at->diffForHumans() }}
                            </h3>
                        </div>
                    </div>
                @else
                    <div class="flex gap-2 flex-grow">
                        <div class="flex flex-col">
                            <h2 class="text-white text-sm font-semibold">Anonymous</h2>
                            <h3 class="text-xs text-gray-500">{{ '@' . 'anonymous' }}</h3>
                        </div>
                    </div>
                @endif
                <div class="flex gap-2 items-center">

                    @can('update', $comment)
                        <button class="edit-comment" id="{{ 'edit_button-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-pencil">
                                <path
                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                <path d="m15 5 4 4" />
                            </svg>
                        </button>

                        <button class="abort-edit hidden" id="{{ 'abort_button-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-x">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m15 9-6 6" />
                                <path d="m9 9 6 6" />
                            </svg>
                        </button>

                        <button class="hidden" id="{{ 'save_button-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-check">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                        </button>
                    @endcan


                    @can('delete', $comment)
                        <button class="delete-comment" id="{{ 'delete_button-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trash-2">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" x2="10" y1="11" y2="17" />
                                <line x1="14" x2="14" y1="11" y2="17" />
                            </svg>
                        </button>
                    @endcan
                    @can('omit',$comment)
                        <button class="omit-comment {{ $comment->is_omitted ? 'hidden' : '' }}" id="{{ 'omit-comment-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-eye-off">
                                <path
                                    d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                                <path
                                    d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                                <path d="m2 2 20 20" />
                            </svg>
                        </button>
                        <button class="unomit-comment {{ $comment->is_omitted ? '' : 'hidden' }}" id="{{ 'unomit-comment-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-eye">
                                <path
                                    d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    @endcan
                </div>
            </div>
            <form class="hidden" id="{{ 'comment-form-' . $comment->id }}">
                <textarea id="{{ 'comment-input-' . $comment->id }}"
                    class="bg-input w-full p-3 mt-5 rounded-xl border border-solid border-white-200 outline-none text-white">{{ trim($comment->content) }}</textarea>
            </form>
            <div class="mt-4" id={{ 'comment-content-' . $comment->id }}>
                {{ $comment->content }}
            </div>
            @if (Auth::check())
                <div class="vote-container mt-3 text-sm flex gap-2 items-center" data-type="comment"
                    data-id="{{ $comment->id }}" data-vote-id="{{ $comment->user_vote_id ?? '' }}"
                    data-vote="{{ $comment->user_vote ?? '' }}" data-authenticated="{{ Auth::check() ? 'true' : 'false' }}">

                    <button type="submit"
                        class="upvote-button hover:bg-green-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-green-400 comment-upvote">

                        <svg class="{{$comment->user_vote == 'upvote' ? 'hidden' : ''}}"
                            id="comment-upvote-outline-{{ $comment->id }}" rpl="" fill="currentColor" icon-name="upvote-outline"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Zm0-17.193L2.685 9.071a.251.251 0 0 0 .177.429H7.5v5.316A2.63 2.63 0 0 0 9.864 17.5a2.441 2.441 0 0 0 1.856-.682A2.478 2.478 0 0 0 12.5 15V9.5h4.639a.25.25 0 0 0 .176-.429L10 1.807Z">
                            </path>
                        </svg>
                        <svg class="{{$comment->user_vote == 'upvote' ? '' : 'hidden'}}"
                            id="comment-upvote-fill-{{ $comment->id }}" rpl="" fill="currentColor" icon-name="upvote-fill"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Z">
                            </path><!--?-->
                        </svg>
                    </button>

                    <span class="vote-count font-bold">{{ $comment->upvotes - $comment->downvotes }}</span>

                    <!-- Downvote Button -->
                    <button type="submit"
                        class="downvote-button hover:bg-red-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-red-400 comment-downvote">

                        <svg class="{{$comment->user_vote == 'downvote' ? 'hidden' : ''}}"
                            id="comment-downvote-outline-{{ $comment->id }}" rpl="" fill="currentColor"
                            icon-name="downvote-outline" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Zm0 17.193 7.315-7.264a.251.251 0 0 0-.177-.429H12.5V5.184A2.631 2.631 0 0 0 10.136 2.5a2.441 2.441 0 0 0-1.856.682A2.478 2.478 0 0 0 7.5 5v5.5H2.861a.251.251 0 0 0-.176.429L10 18.193Z">
                            </path>
                        </svg>
                        <svg class="{{$comment->user_vote == 'downvote' ? '' : 'hidden'}}"
                            id="comment-downvote-fill-{{ $comment->id }}" rpl="" fill="currentColor" icon-name="downvote-fill"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Z">
                            </path><!--?-->
                        </svg>
                    </button>

                    <a
                        class="p-2 rounded-xl cursor-pointer hover:text-cyan-400 hover:bg-cyan-700 hover:bg-opacity-50 sub-comment">
                        <svg xmlns=" http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-message-circle">
                            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                        </svg>
                    </a>


                    <!-- Resto -->
                    {{-- <a class="p-2 rounded-xl cursor-pointer hover:text-rose-400 hover:bg-rose-700 hover:bg-opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-bookmark-plus">
                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                            <line x1="12" x2="12" y1="7" y2="13" />
                            <line x1="15" x2="9" y1="10" y2="10" />
                        </svg> </a>
                    </a>
                    <a class="p-2 rounded-xl cursor-pointer hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-link">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                        </svg> </a>
                    </a> --}}
                </div>
            @endif
        </div>

        @include('partials.comment-input', ['comment-id' => $comment->id])

        @foreach ($comment->replies as $reply)
            @if((Auth::check() && Auth::user()->is_admin) || $reply->is_omitted == false) 
                @include('partials.comment', [
                    'comment' => $reply,
                    'level' => $level + 1,
                    'parent' => $comment,
                    'thread' => $thread,
                ])
            @endif
        @endforeach
    </div>
@else
    <div id="{{ 'comment-' . $comment->id }}" data-auth="{{ Auth::user() && Auth::user()->id }}"
        class="{{ count($comment->parent->replies) > 1 ? 'border-l border-opacity-50 border-solid border-gray-700' : '' }} flex flex-col ml-3 tablet:ml-8 {{ $comment->is_omitted ? 'opacity-50' : '' }}">
        <div
            class="{{ $level == 1 && count($comment->replies) == 0 ? '' : 'border-b border-solid border-gray-700 rounded-bl-xl' }} {{ count($comment->parent->replies) <= 1 ? 'border-l border-opacity-50 border-solid border-gray-700' : 'rounded-xl' }}  p-4">
            <div class="text-sm text-gray-400 flex justify-between items-start">
                @if (Auth::user())
                    <div class="flex gap-2 flex-grow">
                        <img src="{{ $comment->author->profileImage->url }}" class="max-w-8 max-h-8 rounded-full" alt="Profile Image">
                        <div class="flex flex-col">
                            <h2 class="text-white text-sm font-semibold">{{ $comment->author->public_name }}</h2>
                            <h3 class="text-xs text-gray-500">{{ '@' . $comment->author->username }} ·
                                {{ $comment->created_at->diffForHumans() }}
                            </h3>
                        </div>
                    </div>
                @else
                    <div class="flex gap-2 flex-grow">
                        <div class="flex flex-col">
                            <h2 class="text-white text-sm font-semibold">Anonymous</h2>
                            <h3 class="text-xs text-gray-500">{{ '@' . 'anonymous' }}</h3>
                        </div>
                    </div>
                @endif
                <div class="flex gap-2 items-center">
                    @can('update', $comment)
                        <button class="edit-comment" id="{{ 'edit_button-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-pencil">
                                <path
                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                <path d="m15 5 4 4" />
                            </svg>
                        </button>

                        <button class="abort-edit hidden" id="{{ 'abort_button-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-x">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m15 9-6 6" />
                                <path d="m9 9 6 6" />
                            </svg>
                        </button>
                        <button class="hidden" id="{{ 'save_button-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-check">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                        </button>
                    @endcan

                    @can('delete', $comment)
                        <button class="delete-comment" id="{{ 'delete_button-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trash-2">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" x2="10" y1="11" y2="17" />
                                <line x1="14" x2="14" y1="11" y2="17" />
                            </svg>
                        </button>
                    @endcan
                    @can('omit',$comment)
                        <button class="omit-comment {{ $comment->is_omitted ? 'hidden' : '' }}" id="{{ 'omit-comment-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-eye-off">
                                <path
                                    d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                                <path
                                    d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                                <path d="m2 2 20 20" />
                            </svg>
                        </button>
                        <button class="unomit-comment {{ $comment->is_omitted ? '' : 'hidden' }}" id="{{ 'unomit-comment-' . $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-eye">
                                <path
                                    d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    @endcan
                </div>
            </div>
            <form class="hidden" id="{{ 'comment-form-' . $comment->id }}">
                <textarea id="{{ 'comment-input-' . $comment->id }}"
                    class="bg-input w-full p-3 mt-5 rounded-xl border border-solid border-white-200 outline-none text-white">{{ trim($comment->content) }}</textarea>
            </form>
            <div class="mt-4" id={{ 'comment-content-' . $comment->id }}>
                {{ $comment->content }}
            </div>

            @if (Auth::check())
                <div class="vote-container mt-3 text-sm flex gap-2 items-center" data-type="comment"
                    data-id="{{ $comment->id }}" data-vote-id="{{ $comment->user_vote_id ?? '' }}"
                    data-vote="{{ $comment->user_vote ?? '' }}" data-authenticated="{{ Auth::check() ? 'true' : 'false' }}">

                    <button type="submit"
                        class="upvote-button hover:bg-green-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-green-400 comment-upvote">

                        <svg class="{{$comment->user_vote == 'upvote' ? 'hidden' : ''}}"
                            id="comment-upvote-outline-{{ $comment->id }}" rpl="" fill="currentColor" icon-name="upvote-outline"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Zm0-17.193L2.685 9.071a.251.251 0 0 0 .177.429H7.5v5.316A2.63 2.63 0 0 0 9.864 17.5a2.441 2.441 0 0 0 1.856-.682A2.478 2.478 0 0 0 12.5 15V9.5h4.639a.25.25 0 0 0 .176-.429L10 1.807Z">
                            </path>
                        </svg>
                        <svg class="{{$comment->user_vote == 'upvote' ? '' : 'hidden'}}"
                            id="comment-upvote-fill-{{ $comment->id }}" rpl="" fill="currentColor" icon-name="upvote-fill"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Z">
                            </path>
                        </svg>
                    </button>

                    <span class="vote-count font-bold">{{ $comment->upvotes - $comment->downvotes }}</span>

                    <!-- Downvote Button -->
                    <button type="submit"
                        class="downvote-button hover:bg-red-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-red-400 comment-downvote">

                        <svg class="{{$comment->user_vote == 'downvote' ? 'hidden' : ''}}"
                            id="comment-downvote-outline-{{ $comment->id }}" rpl="" fill="currentColor"
                            icon-name="downvote-outline" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Zm0 17.193 7.315-7.264a.251.251 0 0 0-.177-.429H12.5V5.184A2.631 2.631 0 0 0 10.136 2.5a2.441 2.441 0 0 0-1.856.682A2.478 2.478 0 0 0 7.5 5v5.5H2.861a.251.251 0 0 0-.176.429L10 18.193Z">
                            </path>
                        </svg>
                        <svg class="{{$comment->user_vote == 'downvote' ? '' : 'hidden'}}"
                            id="comment-downvote-fill-{{ $comment->id }}" rpl="" fill="currentColor" icon-name="downvote-fill"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Z">
                            </path><!--?-->
                        </svg>
                    </button>


                    <a
                        class="p-2 rounded-xl cursor-pointer hover:text-cyan-400 hover:bg-cyan-700 hover:bg-opacity-50 sub-comment">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-message-circle">
                            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                        </svg>
                    </a>


                    <!-- 
                                <a class="p-2 rounded-xl cursor-pointer hover:text-rose-400 hover:bg-rose-700 hover:bg-opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-bookmark-plus">
                                        <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                                        <line x1="12" x2="12" y1="7" y2="13" />
                                        <line x1="15" x2="9" y1="10" y2="10" />
                                    </svg> </a>
                                </a>
                                <a class="p-2 rounded-xl cursor-pointer hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-link">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                    </svg> </a>
                                </a> -->
                </div>
            @endif
        </div>

        @include('partials.comment-input', ['comment-id' => $comment->id])


        @if($level > 1 && $thread == 'multi' && count($comment->replies))
            <a href="{{ url('/news/' . $post->id . '/comment/' . $parent->id) }}"
                class="my-3 ml-3 text-sm hover:underline show-more">
                Show {{ count($comment->replies) }} more
                {{ count($comment->replies) == 1 ? 'answer' : 'answers' }}
            </a>
        @else
            @foreach ($comment->replies as $reply)
                @if((Auth::check() && Auth::user()->is_admin) || $reply->is_omitted == false) 
                    @include('partials.comment', [
                        'comment' => $reply,
                        'level' => $level + 1,
                        'parent' => $parent,
                        'thread' => $thread,
                    ])
                @endif
            @endforeach
        @endif
    </div>
@endif
