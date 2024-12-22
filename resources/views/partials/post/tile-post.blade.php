<div class="p-4 rounded shadow-sm flex flex-col">
    <a href="{{ url('/news/' . $news->id) }}">
        <img src="{{ url($news->titleImage->url) }}" alt="Post Title Image"
            class="w-full h-48 object-cover mb-2 rounded-md">
    </a>

    <div class="flex flex-col justify-between flex-grow">
        <a href="{{ url('/news/' . $news->id) }}">
            <h3 class="text-lg font-bold break-words">{{ $news->title }}</h3>
        </a>

        @include('partials.post.tags', ['tags' => $news->tag_names])

        <div>
            @if (Auth::check())


                <div class="vote-container mr-4 flex items-center" data-type="post" data-id="{{ $news->id }}"
                    data-vote-id="{{ $news->user_vote_id ?? '' }}" data-vote="{{ $news->user_vote ?? '' }}"
                    data-authenticated="{{ Auth::check() ? 'true' : 'false' }}"
                    data-user_bookmark="{{$news->is_bookmarked ? 'true' : 'false'}}">

                    <!-- Upvote Button -->
                    <button type="submit" class="upvote-button flex items-center justify-center mr-1" title="upvote">
                        <div class="{{ $news->user_vote == 'upvote' ? 'hidden' : '' }}"
                            id="post-upvote-outline-{{ $news->id }}">
                            @include('partials.svg.post.upvote-outline')
                        </div>
                        <div class="{{ $news->user_vote == 'upvote' ? '' : 'hidden' }}"
                            id="post-upvote-fill-{{ $news->id }}">
                            @include('partials.svg.post.upvote-fill')
                        </div>
                    </button>

                    <span class="vote-count font-bold text-sm">{{ $news->upvotes - $news->downvotes }}</span>

                    <!-- Downvote Button -->
                    <button type="submit" class="downvote-button flex items-center justify-center ml-1" title="downvote">
                        <div class="{{ $news->user_vote == 'downvote' ? 'hidden' : '' }}"
                            id="post-downvote-outline-{{ $news->id }}">
                            @include('partials.svg.post.downvote-outline')
                        </div>
                        <div class="{{ $news->user_vote == 'downvote' ? '' : 'hidden' }}"
                            id="post-downvote-fill-{{ $news->id }}">
                            @include('partials.svg.post.downvote-fill')
                        </div>
                    </button>

                    <!-- Bookmark Button -->
                    <button type="submit" class="bookmark-button flex items-center justify-center ml-3" title="bookmark">
                        <div class="{{ $news->is_bookmarked ? 'hidden' : '' }}" id="post-bookmark-outline-{{ $news->id }}">
                            @include('partials.svg.post.bookmark-outline')
                        </div>
                        <div class="{{ $news->is_bookmarked ? '' : 'hidden' }}" id="post-bookmark-fill-{{ $news->id }}">
                            @include('partials.svg.post.bookmark-fill')
                        </div>
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