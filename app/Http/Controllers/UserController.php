<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use App\Http\Controllers\NewsPostPaginationTrait;

class UserController extends Controller
{
    use NewsPostPaginationTrait;

    public function showUserPosts(User $user, Request $request)
    {
        $news_posts = NewsPost::where('author_id', $user->id)
            ->orderBy('created_at', 'desc');

        $title = "{$user->public_name}'s Posts";
        $baseUrl = "/users/{$user->id}/posts";

        return $this->news_post_page($news_posts, $title, $request, $baseUrl, ['user' => $user], 'pages.user');
    }

    public function showUserUpvotes(User $user, Request $request)
    {
        $upvotedPostIds = Vote::where('user_id', $user->id)
                          ->where('is_upvote', true)
                          ->where('vote_type', 'PostVote')
                          ->pluck('news_post_id');
        $news_posts = NewsPost::whereIn('id', $upvotedPostIds)
                    ->orderBy('created_at', 'desc');

        $title = "{$user->public_name}'s Upvoted Posts";
        $baseUrl = "/users/{$user->id}/upvotes";

        return $this->news_post_page($news_posts, $title, $request, $baseUrl, ['user' => $user], 'pages.user');
    }
}
