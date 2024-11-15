@extends('layouts.app')

@section('content')
<section class="flex flex-col border-x border-gray-700 self-center ml-64 mr-96 h-full">
    <form action="{{ url('/news') }}" method="POST" enctype="multipart/form-data"
            class="px-3 flex flex-col gap-4 mt-4">
        @csrf

        <!-- Title Photo -->
        <button class="bg-input rounded-3xl px-6 py-8 w-40" id="personalizedFileInput">Thumbnail</button>
        <input class="hidden" type="file" name="title_photo" id="realFileInput">
        

        <!-- Title -->
        <input type="text" name="title" class="rounded-2xl bg-input outline-none p-3" placeholder="Post title*" required>


        <!-- Content -->
        <textarea name="content" class="rounded-2xl bg-input outline-none p-3" required></textarea>


        <!-- Tags -->
        <div class="mb-4">
            <label for="tags" class="block font-bold mb-2">Tags:</label>
            <select name="tags[]" id="tags"
                    class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- For Followers Only -->
        <div class="mb-4">
            <label class="block font-bold mb-2">
                <input type="checkbox" name="for_followers" value="1" class="mr-2">
                For Followers Only
            </label>
        </div>

        <!-- Submit Button -->
        <button class="text-input bg-white font-bold rounded-3xl px-6 py-2 self-end" type="submit">Post</button>

    </form>
</section>
@endsection