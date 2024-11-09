<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All News</h1>
        <ul>
            @foreach ($newsPosts as $news)
                <li>
                    <h2>{{ $news->title }}</h2>
                    <p>{{ $news->content }}</p>
                    <small>Posted by {{ $news->author_id }} on {{ $news->created_at }}</small>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
