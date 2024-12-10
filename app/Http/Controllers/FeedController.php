<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Enums\UserStatusEnum;
use Illuminate\Support\Facades\Log;

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
        return $this->news_post_page($news_posts, $request, route('news.recent'));
    }

    public function myFeed(Request $request)
    {
        $tags = Tag::all()->pluck('name')->toArray();
        return view('pages.news', ['tags' => $tags, 'rankings' => UserStatusEnum::values(), 'title' => 'Your News', 'baseUrl' => null]);
        // $user = Auth::user();
        // $following = $user->following()->pluck('id');
        // $news_posts = NewsPost::whereIn('author_id', $following)
        //     ->orderBy('created_at', 'desc');
        // $tags = Tag::all()->pluck('name')->toArray();
        // return $this->news_post_page($news_posts, "Your News", $request, route('news.my'), ['tags' => $tags, 'rankings' => UserStatusEnum::values()]);
    }

    public function bookmarksFeed(Request $request)
    {
        // $user = Auth::user();
        // $news_posts = $user->bookmarkedPosts();
        // $tags = Tag::all()->pluck('name')->toArray();
        // return $this->news_post_page($news_posts, "Your Bookmarks", $request, route('news.bookmarks'), ['tags' => $tags, 'rankings' => UserStatusEnum::values()]);
        $tags = Tag::all()->pluck('name')->toArray();
        return view('pages.news', ['tags' => $tags, 'rankings' => UserStatusEnum::values(), 'title' => 'Your Bookmarks', 'baseUrl' => null]);
    }
}
