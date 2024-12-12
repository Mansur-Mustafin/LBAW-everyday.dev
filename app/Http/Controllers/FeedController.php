<?php

namespace App\Http\Controllers;

use App\Enums\UserRankEnum;
use App\Models\NewsPost;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    use PaginationTrait;

    public function recentFeed(Request $request)
    {
        $tags = Tag::all()->pluck('name')->toArray();
        return view('pages.news', ['tags' => $tags, 'rankings' => UserRankEnum::values(), 'title' => 'Recent News', 'baseUrl' => route('api.news.recent')]);
    }

    public function getRecentFeed(Request $request)
    {
        $news_posts = NewsPost::query();
        return $this->news_post_page($news_posts, $request);
    }

    public function myFeed(Request $request)
    {
        $tags = Tag::all()->pluck('name')->toArray();
        return view('pages.news', ['tags' => $tags, 'rankings' => UserRankEnum::values(), 'title' => 'Your News', 'baseUrl' => route('api.news.my')]);
    }

    public function getMyFeed(Request $request)
    {
        $user = Auth::user();
        $following = $user->following()->pluck('id');
        $news_posts_by_follow = NewsPost::whereIn('author_id', $following)
            ->orderBy('created_at', 'desc')->get();
        $news_posts_by_tag =  $user->tags()->get()->map(function ($tag, $key) {
            return $tag->newsPosts()->get();
        })->flatten();

        if (!$news_posts_by_follow->merge($news_posts_by_tag)->isEmpty()) {
            $news_posts = $news_posts_by_follow->merge($news_posts_by_tag)->toQuery();
        } else {
            $news_posts = NewsPost::query()->whereNull('id');
        }
        return $this->news_post_page($news_posts, $request);
    }

    public function bookmarkFeed(Request $request)
    {
        $tags = Tag::all()->pluck('name')->toArray();
        return view('pages.news', ['tags' => $tags, 'rankings' => UserRankEnum::values(), 'title' => 'Your Bookmarks', 'baseUrl' => route('api.news.bookmark')]);
    }

    public function getBookmarkFeed(Request $request)
    {
        $user = Auth::user();
        $news_posts = $user->bookmarkedPosts();
        $tags = Tag::all()->pluck('name')->toArray();
        return $this->news_post_page($news_posts, $request);
    }

    public function postFeed(Request $request)
    {
        $search_query = $request->search;
        // $baseUrl = "news/api/posts/{$search_query}";
        $baseUrl = route('api.posts.search', $search_query);
        return view('pages.news', ['title' => 'Related Posts', 'baseUrl' => $baseUrl]);
    }

    public function getPostFeed(Request $request)
    {
        $search_query = $request->search;
        $news_posts = SearchController::getPosts($search_query);

        return $this->news_post_page($news_posts, $request);
    }

    public function tagFeed(Request $request)
    {
        $tag_query = $request->search;
        // $baseUrl = "news/api/tags/{$tag_query}";
        // $baseUrl = "/news/api/recent-feed?page=1&tags[]=AI&date_range=All%20Time&order_by=Sort%20by"
        $baseUrl = route('api.tags.search', $tag_query);
        return view('pages.news', ['title' => 'Tag Related Posts', 'baseUrl' => $baseUrl]);
    }

    public function getTagFeed(Request $request)
    {
        $tag_query = $request->search;
        $tag = Tag::where('name', $tag_query)->first();

        $news_posts = SearchController::getPostsByTag($tag);
        return $this->news_post_page($news_posts, $request, ['tag' => $tag]);
    }
}
