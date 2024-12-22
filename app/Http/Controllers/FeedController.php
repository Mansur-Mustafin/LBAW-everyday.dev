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
        return view('pages.news.news', [
            'tags' => Tag::all()->pluck('name')->toArray(),
            'rankings' => UserRankEnum::values(),
            'title' => 'Recent News',
            'baseUrl' => route('api.news.recent')
        ]);
    }

    public function getRecentFeed(Request $request)
    {
        $news_posts = NewsPost::query();
        return $this->news_post_page($news_posts, $request);
    }

    public function myFeed(Request $request)
    {
        return view('pages.news.news', [
            'tags' => Tag::all()->pluck('name')->toArray(),
            'rankings' => UserRankEnum::values(),
            'title' => 'Your News',
            'baseUrl' => route('api.news.my')
        ]);
    }

    public function getMyFeed(Request $request)
    {
        // TODO:: check maybe has different variant
        /** @var User $user */
        $user = Auth::user();

        $news_posts = NewsPost::query()
            ->whereIn('author_id', $user->following()->pluck('id'))
            ->orWhereHas('tags', function ($query) use ($user) {
                $query->whereIn('id', $user->tags()->pluck('id'));
            });
        return $this->news_post_page($news_posts, $request);
    }

    public function bookmarkFeed(Request $request)
    {
        return view('pages.news.news', [
            'tags' => Tag::all()->pluck('name')->toArray(),
            'rankings' => UserRankEnum::values(),
            'title' => 'Your Bookmarks',
            'baseUrl' => route('api.news.bookmark')
        ]);
    }

    public function getBookmarkFeed(Request $request)
    {
        $user = Auth::user();
        $newsPosts = $user->bookmarkedPosts()->getQuery();

        return $this->news_post_page($newsPosts, $request);
    }

    public function postFeed(Request $request)
    {
        $search_query = $request->search;
        $baseUrl = route('api.posts.search', $search_query);

        return view('pages.news.news', [
            'title' => 'Related Posts',
            'baseUrl' => $baseUrl
        ]);
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
        $baseUrl = route('api.tags.search', $tag_query);

        return view('pages.news.news', [
            'title' => "$tag_query Related Posts",
            'baseUrl' => $baseUrl
        ]);
    }

    public function getTagFeed(Request $request)
    {
        $tag_query = $request->search;
        $tag = Tag::where('name', $tag_query)->first();

        $news_posts = SearchController::getPostsByTag($tag);
        return $this->news_post_page($news_posts, $request);
    }
}
