@extends('layouts.app')

@section('content')
<section class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[42.5rem] h-full">
    <form class="px-3 flex flex-col gap-4 mt-4" method="POST" action="{{ route('news') }}" enctype="multipart/form-data"
        id="createForm">
        @csrf
        <div class="flex">
            <button class="bg-input rounded-3xl px-6 py-8 w-40 min-h-28" id="personalizedFileInput">Thumbnail</button>
            <button id="deleteThumbnail" class="self-start hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-x">
                <circle cx="12" cy="12" r="10" />
                <path d="m15 9-6 6" />
                <path d="m9 9 6 6" />
                </svg>
            </button>
        </div>

        <input name="title" id="title" class="rounded-2xl bg-input outline-none p-3" placeholder="Post title*">
        <textarea name="content" class="rounded-2xl bg-input outline-none p-3 min-h-40"
            placeholder="Share your thoughts"></textarea>
        <div class="flex items-center justify-between">
            <div class='flex items-center gap-2'>
                <select class="bg-input rounded-2xl p-3 w-40" id="tagSelector">
                    <option selected disabled></option>
                    @foreach ($tags as $tag)
                    <option value={{ $tag['name'] }}>{{ $tag['name'] }}</option>
                @endforeach
                </select>
                <label class='hidden laptop:text-sm tablet:block'>Add tags to your post</label>
            </div>
            <div>
                <!-- -- code copied from https://tailgrids.com/components/toggle-switch -->
                <label
                for="toggleTwo"
                class="flex items-center cursor-pointer select-none text-dark dark:text-white gap-2 text-sm"
                >
                <div class="relative">
                    <input
                        type="checkbox"
                        id="toggleTwo"
                        class="peer sr-only"
                            />
                    <div
                        class="block h-8 rounded-full dark:bg-dark-2 bg-input w-14"
                        ></div>
                    <div
                        class="absolute w-6 h-6 transition bg-white rounded-full dot dark:bg-dark-4 left-1 top-1 peer-checked:translate-x-full peer-checked:bg-purple-900"
                        ></div>
                </div>
                Followers only
                </label>
            </div>
        </div>
        <div id="selectedTags" class="flex gap-1 flex-wrap"></div>

        <input class="hidden" name="tags" id="tagsInput">
        <input class="hidden" type="file" id="realFileInput" name="image">
        <input class="hidden" type="text" id="hiddenToggle" name="for_followers" value='false'>
        <button class="text-input bg-white font-bold rounded-xl px-6 py-2 self-end" type="submit">Post</button>
    </form>
</section>
@endsection
