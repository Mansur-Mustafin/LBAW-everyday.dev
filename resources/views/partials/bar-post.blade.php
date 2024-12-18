<div class="flex border border-solid border-gray-700 rounded-xl mt-10  pr-6 tablet:pr-14">
    
    <div class="vote-container flex justify-between items-center" data-type="post"
        data-id="{{ $post->id }}" data-vote-id="{{ $post->user_vote_id ?? '' }}"
        data-vote="{{ $post->user_vote ?? '' }}" data-authenticated="{{ Auth::check() ? 'true' : 'false' }}"
        data-user_bookmark="{{$post->is_bookmarked ? 'true' : 'false'}}">

        <div class="border-r border-solid border-gray-700 p-3 rounded-xl flex gap-1">
            <!-- Upvote Button -->
            <button type="submit"
                class="upvote-button flex items-center justify-center mr-1 hover:bg-green-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-green-400">
                <svg class="{{$post->user_vote == 'upvote' ? 'hidden' : ''}}" id="post-upvote-outline-{{ $post->id }}"
                    rpl="" fill="currentColor" width="20" icon-name="upvote-outline" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Zm0-17.193L2.685 9.071a.251.251 0 0 0 .177.429H7.5v5.316A2.63 2.63 0 0 0 9.864 17.5a2.441 2.441 0 0 0 1.856-.682A2.478 2.478 0 0 0 12.5 15V9.5h4.639a.25.25 0 0 0 .176-.429L10 1.807Z">
                    </path>
                </svg>
                <svg class="{{$post->user_vote == 'upvote' ? '' : 'hidden'}}" id="post-upvote-fill-{{ $post->id }}" rpl=""
                    fill="currentColor" width="20" icon-name="upvote-fill" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Z">
                    </path><!--?-->
                </svg>
            </button>

            <span class="vote-count font-bold mt-1.5">{{ $post->upvotes - $post->downvotes }}</span>

            <!-- Downvote Button -->
            <button type="submit"
                class="downvote-button flex items-center justify-center ml-1 hover:bg-red-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-red-400">
                <svg class="{{$post->user_vote == 'downvote' ? 'hidden' : ''}}" id="post-downvote-outline-{{ $post->id }}"
                    rpl="" fill="currentColor" width="20" icon-name="downvote-outline" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Zm0 17.193 7.315-7.264a.251.251 0 0 0-.177-.429H12.5V5.184A2.631 2.631 0 0 0 10.136 2.5a2.441 2.441 0 0 0-1.856.682A2.478 2.478 0 0 0 7.5 5v5.5H2.861a.251.251 0 0 0-.176.429L10 18.193Z">
                    </path>
                </svg>
                <svg class="{{$post->user_vote == 'downvote' ? '' : 'hidden'}}" id="post-downvote-fill-{{ $post->id }}"
                    rpl="" fill="currentColor" width="20" icon-name="downvote-fill" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Z">
                    </path>
                </svg>
            </button>
        </div>

        <button class="bookmark-button flex group items-center cursor-pointer">
            <div class="p-2 rounded-xl group-hover:text-rose-400 group-hover:bg-rose-700 group-hover:bg-opacity-50">
                <svg class="{{ $post->is_bookmarked ? 'hidden' : '' }}"
                    id="post-bookmark-outline-{{ $post->id }}"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-bookmark-plus">
                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                </svg>
                <svg class="{{ $post->is_bookmarked ? '' : 'hidden' }}"
                    id="post-bookmark-fill-{{ $post->id }}"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-bookmark-plus">
                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                </svg>
            </div>
            <label class="hidden tablet:inline group-hover:text-rose-400 cursor-pointer">Bookmark</label>
        </button>

        <button class="report-button flex group items-center cursor-pointer ml-3" data-post-id="{{ $post->id }}">
            <div class="p-2 rounded-xl group-hover:text-purple-700 group-hover:bg-purple-700 group-hover:bg-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-flag">
                    <path d="M3 3v18" />
                    <path d="M3 3h11l4 5-4 5H3" />
                </svg>
            </div>
            <label class="hidden tablet:inline group-hover:text-purple-700 cursor-pointer">Report</label>
        </button>

        <div id="report-popup-{{ $post->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg w-96">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Report Post</h3>
                
                <form action="{{ route('report.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="news_post_id" value="{{ $post->id }}">
                    <input type="hidden" name="reporter_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="report_type" value="PostReport">
                    <input type="hidden" name="comment_id" value="">
                    <input type="hidden" name="reported_user_id" value="">
                    
                    <textarea name="description" id="report-comment-{{ $post->id }}" 
                            class="w-full p-2 border rounded-lg text-gray-700" 
                            placeholder="Write report's motive" required></textarea>
                    
                    <div class="mt-4 flex justify-end gap-2">
                        <button type="button" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 report-popup-close"
                                data-post-id="{{ $post->id }}">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    

    {{-- <div class="flex gap-1 group items-center cursor-pointer">
        <a class="p-2 rounded-xl group-hover:text-cyan-400 group-hover:bg-cyan-700 group-hover:bg-opacity-50">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-message-circle">
                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
            </svg>
        </a>
        <label class="hidden tablet:inline group-hover:text-cyan-400 cursor-pointer">Comments</label>
    </div>
    
    <div class="flex gap-1 group items-center cursor-pointer">
        <a class="p-2 rounded-xl group-hover:text-purple-400 group-hover:bg-purple-700 group-hover:bg-opacity-50">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-link">
                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
            </svg> </a>
        </a>
        <label class="hidden tablet:inline group-hover:text-purple-400 cursor-pointer">Share</label>
    </div> --}}
</div>