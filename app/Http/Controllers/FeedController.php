<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatusEnum;

class FeedController extends Controller
{
    use PaginationTrait;

    public function recentFeed(Request $request)
    {
        $tags = Tag::all()->pluck('name')->toArray();
        return view('pages.news', ['tags' => $tags, 'rankings' => UserStatusEnum::values(), 'title' => 'Recent News', 'baseUrl' => route('api.news.recent')]);
    }

    public function getRecentFeed(Request $request)
    {
        $news_posts = NewsPost::query()->orderBy('created_at', 'desc');
        return $this->news_post_page($news_posts, $request);
    }

    public function myFeed(Request $request)
    {
        $tags = Tag::all()->pluck('name')->toArray();
        return view('pages.news', ['tags' => $tags, 'rankings' => UserStatusEnum::values(), 'title' => 'Your News', 'baseUrl' => route('api.news.my')]);
    }

    public function getMyFeed(Request $request)
    {
        $user = Auth::user();
        $following = $user->following()->pluck('id');
        $news_posts = NewsPost::query()->whereIn('author_id', $following)->orderBy('created_at', 'desc');
        return $this->news_post_page($news_posts, $request);
    }

    public function bookmarkFeed(Request $request)
    {
        $tags = Tag::all()->pluck('name')->toArray();
        return view('pages.news', ['tags' => $tags, 'rankings' => UserStatusEnum::values(), 'title' => 'Your Bookmarks', 'baseUrl' => route('api.news.bookmark')]);
    }

    public function getBookmarkFeed(Request $request)
    {
        $user = Auth::user();
        $news_posts = $user->bookmarkedPosts();
        $tags = Tag::all()->pluck('name')->toArray();
        return $this->news_post_page($news_posts, $request);
    }
}
