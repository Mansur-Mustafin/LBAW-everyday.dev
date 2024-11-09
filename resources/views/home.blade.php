@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1>Recent News</h1>
        <div class="">
            @foreach ($newsPosts as $news)
                @include('news.tile-post', ['news' => $news])
            @endforeach
        </div>
    </div>
@endsection
