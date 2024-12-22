<div class="p-4 rounded shadow-sm flex flex-col">
    {{-- TODO: da para por dentro de outro link? linha 8? --}}
    <a href="{{ url('/news/' . $news->id) }}">
        <img src="{{ url($news->titleImage->url) }}" alt="" class="w-full h-48 object-cover mb-2 rounded-md">
    </a>

    <div class="flex flex-col justify-between flex-grow">
        <a href="{{ url('/news/' . $news->id) }}">
            <h3 class="text-lg font-bold break-words">{{ $news->title }}</h3>
        </a>

        @include('partials.tags', ['tags' => $news->tag_names])

        <div>
            @if (Auth::check())


                <div class="vote-container mr-4 flex items-center" data-type="post" data-id="{{ $news->id }}"
                    data-vote-id="{{ $news->user_vote_id ?? '' }}" data-vote="{{ $news->user_vote ?? '' }}"
                    data-authenticated="{{ Auth::check() ? 'true' : 'false' }}"
                    data-user_bookmark="{{$news->is_bookmarked ? 'true' : 'false'}}">

                    <!-- Upvote Button -->
                    <button type="submit" class="upvote-button flex items-center justify-center mr-1" title="upvote">
                        <svg class="{{ $news->user_vote == 'upvote' ? 'hidden' : '' }}"
                            id="post-upvote-outline-{{ $news->id }}" rpl="" fill="currentColor" height="16"
                            icon-name="upvote-outline" viewBox="0 0 20 20" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Zm0-17.193L2.685 9.071a.251.251 0 0 0 .177.429H7.5v5.316A2.63 2.63 0 0 0 9.864 17.5a2.441 2.441 0 0 0 1.856-.682A2.478 2.478 0 0 0 12.5 15V9.5h4.639a.25.25 0 0 0 .176-.429L10 1.807Z">
                            </path>
                        </svg>
                        <svg class="{{ $news->user_vote == 'upvote' ? '' : 'hidden' }}"
                            id="post-upvote-fill-{{ $news->id }}" rpl="" fill="currentColor" height="16"
                            icon-name="upvote-fill" viewBox="0 0 20 20" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Z">
                            </path>
                        </svg>
                    </button>

                    <span class="vote-count font-bold text-sm">{{ $news->upvotes - $news->downvotes }}</span>

                    <!-- Downvote Button -->
                    <button type="submit" class="downvote-button flex items-center justify-center ml-1" title="downvote">
                        <svg class="{{ $news->user_vote == 'downvote' ? 'hidden' : '' }}"
                            id="post-downvote-outline-{{ $news->id }}" rpl="" fill="currentColor" height="16"
                            icon-name="downvote-outline" viewBox="0 0 20 20" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Zm0 17.193 7.315-7.264a.251.251 0 0 0-.177-.429H12.5V5.184A2.631 2.631 0 0 0 10.136 2.5a2.441 2.441 0 0 0-1.856.682A2.478 2.478 0 0 0 7.5 5v5.5H2.861a.251.251 0 0 0-.176.429L10 18.193Z">
                            </path>
                        </svg>
                        <svg class="{{ $news->user_vote == 'downvote' ? '' : 'hidden' }}"
                            id="post-downvote-fill-{{ $news->id }}" rpl="" fill="currentColor" height="16"
                            icon-name="downvote-fill" viewBox="0 0 20 20" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Z">
                            </path>
                        </svg>
                    </button>

                    <!-- Bookmark Button -->
                    <button type="submit" class="bookmark-button flex items-center justify-center ml-3" title="bookmark">
                        <svg class="{{ $news->is_bookmarked ? 'hidden' : '' }}" id="post-bookmark-outline-{{ $news->id }}"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-bookmark-plus">
                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                        </svg>
                        <svg class="{{ $news->is_bookmarked ? '' : 'hidden' }}" id="post-bookmark-fill-{{ $news->id }}"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-bookmark-plus">
                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="flex items-center">
                <div class="grow">
                    @if (Auth::check())
                        <p class="text-gray-400 text-sm">By {{ $news->author->public_name }}</p>
                    @endif
                    <p class="text-xs text-gray-500">Posted {{ $news->created_at->diffForHumans() }}</p>
                </div>
                @if ($news->for_followers)
                    <span class="bg-purple text-white px-2 py-1 rounded-lg text-xs">Followers Only</span>
                @endif
            </div>

        </div>
    </div>

</div>