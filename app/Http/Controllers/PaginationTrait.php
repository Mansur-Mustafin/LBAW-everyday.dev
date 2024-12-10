<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait PaginationTrait
{
    public function news_post_page($news_posts, Request $request, $baseUrl = null, $additionalData = [], $view = 'pages.news')
    {
        $tags = $request->input('tags', []);
        $authorRank = $request->input('ranks', []);
        $dateTime = $request->input('date_range', null);
        $user = Auth::user();

        if (!empty($tags)) {
            $news_posts = $news_posts->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('name', $tags);
            });
        }
        if (!empty($authorRank)) {
            $news_posts = $news_posts->whereHas('author', function($query) use ($authorRank) {
                $query->whereIn('rank', $authorRank);
            });
        }
        if (!empty($dateTime) && $dateTime !== 'All Time') {
            switch ($dateTime) {
                case 'Last Day':
                    $news_posts = $news_posts->where('created_at', '>=', now()->subDay());
                    break;
                case 'Last Week':
                    $news_posts = $news_posts->where('created_at', '>=', now()->subWeek());
                    break;
                case 'Last Month':
                    $news_posts = $news_posts->where('created_at', '>=', now()->subMonth());
                    break;
                case 'Last Year':
                    $news_posts = $news_posts->where('created_at', '>=', now()->subYear());
                    break;
            }
        }
        

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

        sleep(1);

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
