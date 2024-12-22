<div class="flex border border-solid border-gray-700 rounded-xl mt-10">

    <div class="vote-container flex justify-between items-center w-full" data-type="post" data-id="{{ $post->id }}"
        data-vote-id="{{ $post->user_vote_id ?? '' }}" data-vote="{{ $post->user_vote ?? '' }}"
        data-authenticated="{{ Auth::check() ? 'true' : 'false' }}"
        data-user_bookmark="{{$post->is_bookmarked ? 'true' : 'false'}}">

        <div class="border-r border-solid border-gray-700 p-3 rounded-xl flex gap-1">
            <!-- Upvote Button -->
            <button type="submit"
                class="upvote-button flex items-center justify-center mr-1 hover:bg-green-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-green-400"
                title="upvote">
                <div class="{{$post->user_vote == 'upvote' ? 'hidden' : ''}}" id="post-upvote-outline-{{ $post->id }}">
                    @include('partials.svg.post.upvote-outline')
                </div>
                <div class="{{$post->user_vote == 'upvote' ? '' : 'hidden'}}" id="post-upvote-fill-{{ $post->id }}">
                    @include('partials.svg.post.upvote-fill')
                </div>
            </button>

            <span class="vote-count font-bold mt-1.5">{{ $post->upvotes - $post->downvotes }}</span>

            <!-- Downvote Button -->
            <button type="submit"
                class="downvote-button flex items-center justify-center ml-1 hover:bg-red-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-red-400"
                title="downvote">
                <div class="{{$post->user_vote == 'downvote' ? 'hidden' : ''}}"
                    id="post-downvote-outline-{{ $post->id }}">
                    @include('partials.svg.post.downvote-outline')
                </div>
                <div class="{{$post->user_vote == 'downvote' ? '' : 'hidden'}}" id="post-downvote-fill-{{ $post->id }}">
                    @include('partials.svg.post.downvote-fill')
                </div>

            </button>
        </div>

        <div class="flex flex-grow gap-6 justify-center tablet:justify-end tablet:mr-6">
            <button class="bookmark-button flex gap-1 group items-center cursor-pointer">
                <div class="p-2 rounded-xl group-hover:text-rose-400 group-hover:bg-rose-700 group-hover:bg-opacity-50">
                    <div class="{{ $post->is_bookmarked ? 'hidden' : '' }}" id="post-bookmark-outline-{{ $post->id }}">
                        @include('partials.svg.post.bookmark-outline')
                    </div>
                    <div class="{{ $post->is_bookmarked ? '' : 'hidden' }}" id="post-bookmark-fill-{{ $post->id }}">
                        @include('partials.svg.post.bookmark-fill')
                    </div>

                </div>
                <label class="hidden tablet:inline group-hover:text-rose-400 cursor-pointer">Bookmark</label>
            </button>


            <button class="flex gap-1 group items-center cursor-pointer relative" id="share-post">
                <span
                    class="copied-feedback absolute bottom-10 left-6 opacity-0 transition-opacity duration-300 text-sm bg-input px-1.5 py-0.5 rounded-lg">copied</span>
                <div class="p-2 rounded-xl group-hover:text-purple group-hover:bg-purple group-hover:bg-opacity-50">
                    @include('partials.svg.user.share')
                </div>

                <label class="hidden tablet:inline group-hover:text-purple cursor-pointer">Share</label>
            </button>
        </div>

    </div>




</div>