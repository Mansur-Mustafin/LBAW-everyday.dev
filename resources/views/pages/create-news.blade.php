@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <form action="{{ url('/news') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title"
                       class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       required>
            </div>

            <!-- Title Photo -->
            <div class="mb-4">
                <label for="title_photo" class="block font-bold mb-2">Title Photo:</label>
                <input type="file" name="title_photo" id="title_photo"
                       class="border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Content -->
            <div class="mb-4">
                <label for="content" class="block font-bold mb-2">Content:</label>
                <textarea name="content" id="content" rows="5"
                          class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          required></textarea>
            </div>

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
            <div>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create News Post
                </button>
            </div>
        </form>
    </div>
@endsection