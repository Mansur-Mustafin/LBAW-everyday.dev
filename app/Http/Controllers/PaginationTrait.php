<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait PaginationTrait
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

    public function paginate_users($users, Request $request)
    {
        $users = $users->paginate(10);

        return response()->json([
            'data'     => $users->items(),
            'next-page' => $users->currentPage() + 1,
            'last_page' => $users->lastPage()
        ]);
    }

    public function paginate_tags($tags, Request $request)
    {
        $tags = $tags->paginate(10);


        return response()->json([
            'tags'      => $tags,
            'next-page' => $tags->currentPage() + 1,
            'last_page' => $tags->lastPage()
        ]);
    }

    public function paginate_tag_proposals($tag_proposals,Request $request)
    {
        $tag_proposals = $tag_proposals->with('proposer')->paginate(10);

        return response()->json([
            'tag_proposals' => $tag_proposals,
            'next-page' => $tag_proposals->currentPage() + 1,
            'last_page' => $tag_proposals->lastPage()
        ]);
    }
}
