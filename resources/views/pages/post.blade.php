@extends('layouts.app')

@section('content')
<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-[42rem] px-10 py-12 border-x border-gray-700">
        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
        <div class="flex flex-wrap mt-5 gap-2">
            @foreach ($post->tags as $tag)
                <span class="text-md text-gray-400 font-medium lowercase bg-input px-3  rounded-md">#{{ $tag->name }}</span>
            @endforeach
        </div>
        <div class="mt-5 text-sm text-gray-400">
            {{ $post->created_at->diffForHumans() }} • By {{ $post->author->username }}
        </div>
        <div class="mt-10">
           {{ $post->content }}
        </div>
        <div class="flex border border-solid border-gray-700 rounded-xl mt-10 items-center justify-between pr-6 tablet:pr-14">
            <div class="border-r border-solid border-gray-700 p-3 rounded-xl flex gap-1">
                <a href="" class="hover:bg-green-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-green-400">
                    <svg rpl="" fill="currentColor" width=20 icon-name="upvote-outline" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Zm0-17.193L2.685 9.071a.251.251 0 0 0 .177.429H7.5v5.316A2.63 2.63 0 0 0 9.864 17.5a2.441 2.441 0 0 0 1.856-.682A2.478 2.478 0 0 0 12.5 15V9.5h4.639a.25.25 0 0 0 .176-.429L10 1.807Z"></path>
                    </svg>
                </a>
                <a href="" class="hover:bg-red-800 hover:bg-opacity-50 p-2 rounded-xl hover:text-red-400">
                    <svg rpl="" fill="currentColor" icon-name="downvote-outline" viewBox="0 0 20 20" width=20 xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 1c.072 0 .145 0 .218.006A4.1 4.1 0 0 1 14 5.184V9h3.138a1.751 1.751 0 0 1 1.234 2.993L10.59 19.72a.836.836 0 0 1-1.18 0l-7.782-7.727A1.751 1.751 0 0 1 2.861 9H6V5.118a4.134 4.134 0 0 1 .854-2.592A3.99 3.99 0 0 1 10 1Zm0 17.193 7.315-7.264a.251.251 0 0 0-.177-.429H12.5V5.184A2.631 2.631 0 0 0 10.136 2.5a2.441 2.441 0 0 0-1.856.682A2.478 2.478 0 0 0 7.5 5v5.5H2.861a.251.251 0 0 0-.176.429L10 18.193Z"></path>
                    </svg>
                </a>
            </div>
            <div class="flex gap-1 group items-center cursor-pointer">
                <a class="p-2 rounded-xl group-hover:text-cyan-400 group-hover:bg-cyan-700 group-hover:bg-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
                </a>
                <label class="hidden tablet:inline group-hover:text-cyan-400 cursor-pointer">Comments</label>
            </div>
            <div class="flex gap-1 group items-center">
                <a class="p-2 rounded-xl group-hover:text-rose-400 cursor-pointer group-hover:bg-rose-700 group-hover:bg-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-plus"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/><line x1="12" x2="12" y1="7" y2="13"/><line x1="15" x2="9" y1="10" y2="10"/></svg>                </a>
                <label class="hidden tablet:inline group-hover:text-rose-400 cursor-pointer">Bookmark</label>
            </div>
            <div class="flex gap-1 group items-center cursor-pointer">
                <a class="p-2 rounded-xl group-hover:text-purple-400 group-hover:bg-purple-700 group-hover:bg-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>                </a>
                <label class="hidden tablet:inline group-hover:text-purple-400 cursor-pointer">Share</label>
            </div>
        </div>
        <div class="mt-10 flex items-center">
            <input type="text" class="p-4 w-full border border-solid border-gray-700 bg-input rounded-xl" placeholder="Share your thoughts">
            <button class="-ml-20 border border-solid border-gray-700 px-5 py-2 rounded-xl ">Post</button>
        </div>

        <div class="mt-10">
            <h2 class="text-xl font-bold mb-4">Comments</h2>
            @forelse ($post->comments->where('parent_comment_id', null) as $comment)
                @include('partials.comment', ['comment' => $comment, 'level' => 0])
            @empty
                <div class="text-gray-400">
                    No comments yet. Be the first to comment!
                </div>
            @endforelse
        </div>
    </section>
    <section class="hidden laptop:flex laptop:flex-col laptop:border-r laptop:p-4 laptop:border-gray-700 laptop:w-[20rem]">
        <input/>
    </section>
</section>
@endsection
