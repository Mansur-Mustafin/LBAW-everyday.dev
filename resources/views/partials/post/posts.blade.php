@foreach ($news_posts as $news)
    @include('partials.post.tile-post', ['news' => $news])
@endforeach