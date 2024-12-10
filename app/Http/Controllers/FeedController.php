<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Enums\UserStatusEnum;

class FeedController extends Controller
{
    use PaginationTrait;

    public function recentFeed(Request $request)
    {
        $news_posts = NewsPost::orderBy('created_at', 'desc');
        $tags = Tag::all()->pluck('name')->toArray();
        return $this->news_post_page($news_posts, "Recent News", $request, route('news.recent'), ['tags' => $tags, 'rankings' => UserStatusEnum::values()]);
    }

    public function topFeed(Request $request)
    {
        $news_posts = NewsPost::orderBy(DB::raw('upvotes - downvotes'), 'desc');
        $tags = Tag::all()->pluck('name')->toArray();
        return $this->news_post_page($news_posts, "Top News", $request, route('news.top'), ['tags' => $tags, 'rankings' => UserStatusEnum::values()]);
    }

    public function myFeed(Request $request)
    {
        $user = Auth::user();
        $following = $user->following()->pluck('id');
        $news_posts = NewsPost::whereIn('author_id', $following)
            ->orderBy('created_at', 'desc');
        $tags = Tag::all()->pluck('name')->toArray();
        return $this->news_post_page($news_posts, "Your News", $request, route('news.my'), ['tags' => $tags, 'rankings' => UserStatusEnum::values()]);
    }

    public function bookmarksFeed(Request $request)
    {
        $user = Auth::user();
        $news_posts = $user->bookmarkedPosts();
        $tags = Tag::all()->pluck('name')->toArray();
        return $this->news_post_page($news_posts, "Your Bookmarks", $request, route('news.bookmarks'), ['tags' => $tags, 'rankings' => UserStatusEnum::values()]);
    }
}
