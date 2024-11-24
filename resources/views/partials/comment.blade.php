@php
    $level = $level ?? 0;
@endphp

@if($level == 0)
    <div class="border border-solid border-gray-700 rounded-xl flex flex-col" id="{{ 'comment-' . $comment->id }}"
        data-replies="{{count($comment->replies) == 0 ? 'false' : 'true'}}">
        <div class="{{ count($comment->replies) == 0 ? '' : 'border-b border-solid border-gray-700'}} rounded-xl p-4">
            <div class="text-sm text-gray-400 flex gap-2">
                <img src="{$user->getProfileImage()}">
                <div class="flex flex-col">
                    <h2 class="text-white text-sm font-semibold">{{$comment->user->public_name}}</h2>
                    <h3 class="text-xs text-gray-500">{{'@' . $comment->user->username}} ·
                        {{$comment->created_at->diffForHumans()}}
                    </h3>
                </div>
            </div>
            <div class="mt-4">
                {{ $comment->content . $comment->id}}
            </div>
            <div class="mt-3 text-sm flex gap-3">
                <a
                    class="p-2 rounded-xl cursor-pointer hover:text-cyan-400 hover:bg-cyan-700 hover:bg-opacity-50 sub-comment">
                    <svg xmlns=" http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-message-circle">
                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                    </svg>
                </a>
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
                </a>
            </div>
        </div>

        @foreach ($comment->replies as $reply)
            @include('partials.comment', ['comment' => $reply, 'level' => $level + 1, 'parent' => $comment])
        @endforeach
    </div>

@elseif($level > 2 && $thread == 'multi')
    <a href="{{ url('/news/' . $post->id . '/comment/' . $parent->id) }}" class="mt-3 ml-3 text-sm hover:underline"
        id="showMore">
        Show {{ count($comment->parent->replies)}} more {{count($comment->parent->replies) == 1 ? 'answer' : 'answers' }}
    </a>

@else
    <div id="{{ 'comment-' . $comment->id }}"
        class="{{ count($comment->parent->replies) > 1 ? 'border-l border-opacity-50 border-solid border-gray-700' : ''}} flex flex-col ml-3 tablet:ml-8">
        <div
            class="{{ $level == 1 && count($comment->replies) == 0 ? '' : 'border-b border-solid border-gray-700 rounded-bl-xl'}} {{count($comment->parent->replies) <= 1 ? 'border-l border-opacity-50 border-solid border-gray-700' : 'rounded-xl'}}  p-4">
            <div class="text-sm text-gray-400 flex gap-2">
                <img src="{$user->getProfileImage()}">
                <div class="flex flex-col">
                    <h2 class="text-white text-sm font-semibold">{{$comment->user->public_name}}</h2>
                    <h3 class="text-xs text-gray-500">{{'@' . $comment->user->username}} ·
                        {{$comment->created_at->diffForHumans()}}
                    </h3>
                </div>
            </div>
            <div class="mt-4">
                {{ $comment->content . $comment->id}}
            </div>
            <div class="mt-3 text-sm flex gap-3">
                <a
                    class="p-2 rounded-xl cursor-pointer hover:text-cyan-400 hover:bg-cyan-700 hover:bg-opacity-50 sub-comment">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-message-circle">
                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                    </svg>
                </a>
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
                </a>
            </div>
        </div>

        @foreach ($comment->replies as $reply)
            @include('partials.comment', ['comment' => $reply, 'level' => $level + 1, 'parent' => $parent])
        @endforeach
    </div>
@endif