@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-semibold mb-4">{{ $post->title }}</h1>
    {{-- <img src="{{ $post->title_image_path }}" alt="" class="w-full h-48 object-cover mb-2"> --}}
    <div class="flex flex-wrap gap-2 mb-2 mt-1">
        @foreach ($post->tag_names as $tag)
            <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm">{{$tag}}</span>
        @endforeach
    </div>
    <div class="text-black grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold">Created</h2>
            <p>{{ $post->time_ago }}</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold">Author</h2>
            <a href="{{ url('/users/' . $post->author->id) }}"> {{ Auth::user()->username }} </a>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold">Content</h2>
            <p>{{ $post->content }}</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <img src="/{{ $post->title_image_path }}" alt="" class="w-full h-48 object-cover mb-2">
        </div>
    </div>
    @if (Auth::user()->id == $post->author_id)
        <form method="POST" action="/news/{{ $post->id }}" class="mt-5">
            @csrf
            @method('DELETE')
            <button class="text-input bg-white font-bold rounded-3xl px-6 py-2 self-end" type="submit">Delete post</button>
        </form>
    @endif
</div>
@endsection