<?php

namespace App\Http\Controllers;

use App\Filters\NewsPostFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait PaginationTrait
{
    public function news_post_page($news_posts, Request $request, $additionalData = [], $view = 'pages.news')
    {
        $filter = new NewsPostFilter($request);

        $news_posts = $filter->apply($news_posts);
        $user = Auth::user();

        if ($user) {
            $news_posts->with([
                'votes' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }
            ]);
        }

        $news_posts = $news_posts->paginate(12);
        $userBookmarks = $user ? $user->bookmarkedPosts->pluck('id')->toArray() : [];

        // TODO: solucao melhor?
        foreach ($news_posts as $news) {
            $news->user_vote = null;
            $news->is_bookmarked = false;

            if ($user) {
                $vote = $news->votes->first();

                if ($vote) {
                    $news->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                    $news->user_vote_id = $vote->id;
                }

                $news->is_bookmarked = in_array($news->id, $userBookmarks);
            }
        }

        return response()->json([
            'news_posts' => view('partials.posts', compact('news_posts'))->render(),
            'next_page'  => $news_posts->currentPage() + 1,
            'last_page'  => $news_posts->lastPage()
        ]);
    }

    public function paginate_users($users, Request $request)
    {
        $users = $users->paginate(10);

        return response()->json([
            'data'     => $users->items(),
            'next-page' => $users->currentPage() + 1,
            'last_page' => $users->lastPage()
        ]);
    }
}
