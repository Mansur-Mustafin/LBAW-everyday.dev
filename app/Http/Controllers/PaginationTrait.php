<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait PaginationTrait
{
    public function news_post_page($news_posts, string $title, Request $request, $baseUrl = null, $additionalData = [], $view = 'pages.news')
    {
        $user = Auth::user();

        if($user) {
            $news_posts = $news_posts->with([
                'votes' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }
            ])->paginate(12);
        } else {
            $news_posts = $news_posts->paginate(12);
        }

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
        $tags = $tags->paginate(12);

        return response()->json([
            'data'      => $tags->items(),
            'next-page' => $tags->currentPage() + 1,
            'last_page' => $tags->lastPage()
        ]);
    }

    public function paginate_tag_proposals($tag_proposals,Request $request)
    {
        $tag_proposals = $tag_proposals->paginate(10);

        return response()->json([
            'data' => $tag_proposals->items(),
            'next-page' => $tag_proposals->currentPage() + 1,
            'last_page' => $tag_proposals->lastPage()
        ]);
    }

    public function paginate_unblock_appeals($unblock_appeals,Request $request)
    {
        $unblock_appeals = $unblock_appeals->paginate(10);

        return response()->json([
            'data' => $unblock_appeals->items(),
            'next-page' => $unblock_appeals->currentPage() + 1,
            'last_page' => $unblock_appeals->lastPage()
        ]);
    }
}
