<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    use PaginationTrait;

    public function recentFeed(Request $request)
    {
        $news_posts = NewsPost::orderBy('created_at', 'desc');
        return $this->news_post_page($news_posts, "Recent News", $request, route('news.recent'));
    }

    public function topFeed(Request $request)
    {
        $news_posts = NewsPost::orderBy(DB::raw('upvotes - downvotes'), 'desc');
        return $this->news_post_page($news_posts, "Top News", $request, route('news.top'));
    }

    public function myFeed(Request $request)
    {
        $user = Auth::user();
        $following = $user->following()->pluck('id');
        $news_posts = NewsPost::whereIn('author_id', $following)
            ->orderBy('created_at', 'desc');
        return $this->news_post_page($news_posts, "Your News", $request, route('news.my'));
    }
}
