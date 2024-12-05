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
        $news_posts_by_follow = NewsPost::whereIn('author_id', $following)
            ->orderBy('created_at', 'desc')->get();
        $news_posts_by_tag =  $user->tags()->get()->map(function ($tag,$key) {
            return $tag->newsPosts()->get();
        })->flatten();

        $news_posts = $news_posts_by_follow->merge($news_posts_by_tag);


        dd(gettype($news_posts));

        return $this->news_post_page($news_posts, "Your News", $request, route('news.my'));
    }
}
