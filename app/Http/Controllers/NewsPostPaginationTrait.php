<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait NewsPostPaginationTrait
{
    public function news_post_page($news_posts, string $title, Request $request, $baseUrl = null, $additionalData = [], $view = 'pages.news')
    {
        $news_posts = $news_posts->paginate(12);
        $user = Auth::user();
        foreach ($news_posts as $news) {
            $news->user_vote = null;

            if ($user) {
                $vote = $news->votes()->where('user_id', $user->id)->first();

                if ($vote) {
                    $news->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                    $news->user_vote_id = $vote->id;
                }
            }
        }


        if ($request->ajax()) {
            return response()->json([
                'news_posts' => view('partials.posts', compact('news_posts'))->render(),
                'next_page'  => $news_posts->currentPage() + 1,
                'last_page'  => $news_posts->lastPage()
            ]);
        }

        if (is_null($baseUrl)) {
            $baseUrl = $request->url();
        }

        $data = array_merge(compact('news_posts', 'title', 'baseUrl'), $additionalData);

        return view($view, $data);
    }
}
