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
        $news_posts_by_tag =  $user->tags()->get()->map(function ($tag,$key) {
            return $tag->newsPosts()->get();
        })->flatten();
        
        if(!$news_posts_by_follow->merge($news_posts_by_tag)->isEmpty()) {
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
}
