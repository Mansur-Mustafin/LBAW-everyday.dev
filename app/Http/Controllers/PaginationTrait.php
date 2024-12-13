<?php

namespace App\Http\Controllers;

use App\Filters\NewsPostFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

trait PaginationTrait
{
    public function news_post_page(Builder $newsPosts, Request $request, array $additionalData = [], string $view = 'pages.news')
    {
        $filter = new NewsPostFilter($request);

        $newsPosts = $filter->apply($newsPosts);
        $user = Auth::user();

        if ($user) {
            $newsPosts->with([
                'votes' => fn ($query) => $query->where('user_id', $user->id),
            ]);
        }

        $newsPosts = $newsPosts->paginate(12);

        // $transformedPosts = $newsPosts->map(function ($news) use ($user) {
        //     $news->user_vote = $user && $news->votes->isNotEmpty()
        //         ? ($news->votes->first()->is_upvote ? 'upvote' : 'downvote')
        //         : null;
    
        //     $news->is_bookmarked = $user && $user->bookmarkedPosts->pluck('id')->contains($news->id);
    
        //     return $news;
        // });

        $userBookmarks = $user ? $user->bookmarkedPosts->pluck('id')->toArray() : [];

        foreach ($newsPosts as $newsPost) {
            $newsPost->user_vote = null;
            $newsPost->is_bookmarked = false;

            if ($user) {
                $vote = $newsPost->votes->first();

                if ($vote) {
                    $newsPost->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                    $newsPost->user_vote_id = $vote->id;
                }

                $newsPost->is_bookmarked = in_array($newsPost->id, $userBookmarks);
            }
        }

        return response()->json([
            'news_posts' => view('partials.posts', ['news_posts' => $newsPosts])->render(),
            'next_page'  => $newsPosts->currentPage() + 1,
            'last_page'  => $newsPosts->lastPage()
        ]);
    }

    private function paginate(Builder $query, Request $request, int $perPage = 10)
    {
        $paginated = $query->paginate($perPage);

        return response()->json([
            'data' => $paginated->items(),
            'next_page' => $paginated->currentPage() + 1,
            'last_page' => $paginated->lastPage(),
        ]);
    }
}
