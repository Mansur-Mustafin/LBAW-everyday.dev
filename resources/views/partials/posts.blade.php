@foreach ($news_posts as $news)
    @include('partials.tile-post', ['news' => $news])
@endforeach