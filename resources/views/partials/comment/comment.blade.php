@php
    $level = $level ?? 0;
@endphp

@if ($level == 0)
    <div class="border border-solid border-gray-700 rounded-xl flex flex-col {{ $comment->is_omitted ? 'opacity-50' : '' }} "
        id="{{ 'comment-' . $comment->id }}" data-auth="{{ Auth::user() && Auth::user()->id }}"
        data-replies="{{ count($comment->replies) == 0 ? 'false' : 'true' }}">
        <div class="{{ count($comment->replies) == 0 ? '' : 'border-b border-solid border-gray-700' }} rounded-xl p-4">
            <div class="text-sm text-gray-400 flex justify-between items-start">
                @if (Auth::user())
                    <div class="flex gap-2 flex-grow">
                        <img src="{{ $comment->author->profileImage->url }}" class="max-w-8 max-h-8 rounded-full"
                            alt="Profile Image">
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
                        <button class="edit-comment" id="{{ 'edit_button-' . $comment->id }}" title="edit comment">
                            @include('partials.svg.comment.edit')
                        </button>

                        <button class="abort-edit hidden" id="{{ 'abort_button-' . $comment->id }}" title="abort">
                            @include('partials.svg.comment.abort')
                        </button>

                        <button class="hidden" id="{{ 'save_button-' . $comment->id }}" title="save">
                            @include('partials.svg.comment.save')
                        </button>
                    @endcan


                    @can('delete', $comment)
                        <button class="delete-comment" id="{{ 'delete_button-' . $comment->id }}" title="delete comment">
                            @include('partials.svg.comment.delete')
                        </button>
                    @endcan
                    @can('omit', $comment)
                        <button class="omit-comment {{ $comment->is_omitted ? 'hidden' : '' }}" title="omit comment"
                            id="{{ 'omit-comment-' . $comment->id }}">
                            @include('partials.svg.comment.omit')
                        </button>
                        <button class="unomit-comment {{ $comment->is_omitted ? '' : 'hidden' }}" title="unomit comment"
                            id="{{ 'unomit-comment-' . $comment->id }}">
                            @include('partials.svg.comment.unomit')
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
                        class="upvote-button hover:bg-green-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-green-400 comment-upvote"
                        title="upvote">

                        <div class="{{$comment->user_vote == 'upvote' ? 'hidden' : ''}}"
                            id="comment-upvote-outline-{{ $comment->id }}">
                            @include('partials.svg.post.upvote-outline')
                        </div>

                        <div class="{{$comment->user_vote == 'upvote' ? '' : 'hidden'}}"
                            id="comment-upvote-fill-{{ $comment->id }}">
                            @include('partials.svg.post.upvote-fill')
                        </div>


                    </button>

                    <span class="vote-count font-bold">{{ $comment->upvotes - $comment->downvotes }}</span>

                    <!-- Downvote Button -->
                    <button type="submit"
                        class="downvote-button hover:bg-red-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-red-400 comment-downvote"
                        title="downvote">

                        <div class="{{$comment->user_vote == 'downvote' ? 'hidden' : ''}}"
                            id="comment-downvote-outline-{{ $comment->id }}">
                            @include('partials.svg.post.downvote-outline')
                        </div>

                        <div class="{{$comment->user_vote == 'downvote' ? '' : 'hidden'}}"
                            id="comment-downvote-fill-{{ $comment->id }}">
                            @include('partials.svg.post.downvote-fill')
                        </div>

                    </button>

                    <a class="p-2 rounded-xl cursor-pointer hover:text-cyan-400 hover:bg-cyan-700 hover:bg-opacity-50 sub-comment"
                        title="comment">
                        @include('partials.svg.comment.comment')
                    </a>
                </div>
            @endif
        </div>

        @include('partials.comment.comment-input', ['comment-id' => $comment->id])

        @foreach ($comment->replies as $reply)
            @if((Auth::check() && Auth::user()->is_admin) || $reply->is_omitted == false)
                @include('partials.comment.comment', [
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
                        <img src="{{ $comment->author->profileImage->url }}" class="max-w-8 max-h-8 rounded-full"
                            alt="Profile Image">
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
                            @include('partials.svg.comment.edit')
                        </button>

                        <button class="abort-edit hidden" id="{{ 'abort_button-' . $comment->id }}">
                            @include('partials.svg.comment.delete')
                        </button>
                        <button class="hidden" id="{{ 'save_button-' . $comment->id }}">
                            @include('partials.svg.comment.save')
                        </button>
                    @endcan

                    @can('delete', $comment)
                        <button class="delete-comment" id="{{ 'delete_button-' . $comment->id }}">
                            @include('partials.svg.comment.delete')
                        </button>
                    @endcan
                    @can('omit', $comment)
                        <button class="omit-comment {{ $comment->is_omitted ? 'hidden' : '' }}"
                            id="{{ 'omit-comment-' . $comment->id }}">
                            @include('partials.svg.comment.omit')
                        </button>
                        <button class="unomit-comment {{ $comment->is_omitted ? '' : 'hidden' }}"
                            id="{{ 'unomit-comment-' . $comment->id }}">
                            @include('partials.svg.comment.unomit')
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

                        <div class="{{$comment->user_vote == 'upvote' ? 'hidden' : ''}}"
                            id="comment-upvote-outline-{{ $comment->id }}">
                            @include('partials.svg.post.upvote-outline')
                        </div>
                        <div class="{{$comment->user_vote == 'upvote' ? '' : 'hidden'}}"
                            id="comment-upvote-fill-{{ $comment->id }}">
                            @include('partials.svg.post.upvote-fill')
                        </div>
                    </button>

                    <span class="vote-count font-bold">{{ $comment->upvotes - $comment->downvotes }}</span>

                    <!-- Downvote Button -->
                    <button type="submit"
                        class="downvote-button hover:bg-red-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-red-400 comment-downvote">

                        <div class="{{$comment->user_vote == 'downvote' ? 'hidden' : ''}}"
                            id="comment-downvote-outline-{{ $comment->id }}">
                            @include('partials.svg.post.downvote-outline')
                        </div>
                        <div class="{{$comment->user_vote == 'downvote' ? '' : 'hidden'}}"
                            id="comment-downvote-fill-{{ $comment->id }}">
                            @include('partials.svg.post.downvote-fill')
                        </div>
                    </button>
                    <button
                        class="p-2 rounded-xl cursor-pointer hover:text-cyan-400 hover:bg-cyan-700 hover:bg-opacity-50 sub-comment">
                        @include('partials.svg.comment.comment')
                    </button>
                </div>
            @endif
        </div>

        @include('partials.comment.comment-input', ['comment-id' => $comment->id])


        @if($level > 1 && $thread == 'multi' && count($comment->replies))
            <a href="{{ url('/news/' . $post->id . '/comment/' . $parent->id) }}"
                class="my-3 ml-3 text-sm hover:underline show-more">
                Show {{ count($comment->replies) }} more
                {{ count($comment->replies) == 1 ? 'answer' : 'answers' }}
            </a>
        @else
            @foreach ($comment->replies as $reply)
                @if((Auth::check() && Auth::user()->is_admin) || $reply->is_omitted == false)
                    @include('partials.comment.comment', [
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