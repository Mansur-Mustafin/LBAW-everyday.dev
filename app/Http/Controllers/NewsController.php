<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function news_post_page($news_posts, string $title, Request $request, $baseUrl = null)
    {
        $news_posts = $news_posts->paginate(10);
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

        return view('pages.news', compact('news_posts', 'title', 'baseUrl'));
    }

    public function index(Request $request)
    {
        $news_posts = NewsPost::orderBy('created_at', 'desc');
        $title = "Recent News";
        return NewsController::news_post_page($news_posts, $title, $request);
    }

    public function recent_feed(Request $request)
    {
        $news_posts = NewsPost::orderBy('created_at', 'desc');
        $title = "Recent News";
        $baseUrl = '/news/recent-feed';
        return NewsController::news_post_page($news_posts, $title, $request, $baseUrl);
    }

    public function top_feed(Request $request)
    {
        $news_posts = NewsPost::orderBy(DB::raw('upvotes - downvotes'), 'desc');
        $title = "Top News";
        $baseUrl = '/news/top-feed';
        return NewsController::news_post_page($news_posts, $title, $request, $baseUrl);
    }

    public function my_feed(Request $request)
    {
        $user = Auth::user();
        $title = "Your News";
        $following = $user->following()->pluck('id');
        $news_posts = NewsPost::whereIn('author_id', $following)
            ->orderBy('created_at', 'desc');
        $baseUrl = '/news/my-feed';
        return NewsController::news_post_page($news_posts, $title, $request, $baseUrl);
    }

    public function showCreationForm()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $tags = Tag::all();

        return view('pages.create-news', ['tags' => $tags]);
    }

    public function show(newsPost $newsPost)
    {
        return view('pages.post', ['post' => $newsPost]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:40',
            'content' => 'required|string|max:1000',
            'for_followers' => 'required|string',
            'title_photo' => 'required|file|mimes:jpg,png|max:2048',
            'tags' => 'nullable|string'
        ]);


        $post = NewsPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'for_followers' => $request->for_followers,
            'author_id' => Auth::user()->id,
        ]);


        FileController::upload($request, $post);

        if ($request->tags != null) {
            $tags = explode(',', $request->tags);
            $tagIds = Tag::whereIn('name', $tags)->pluck('id')->toArray();
            $post->tags()->attach($tagIds);
        }


        return redirect()->route('home')
            ->withSuccess('You have successfully created post!');
    }

    public function update(Request $request, newsPost $newsPost)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string|max:40',
            'for_followers' => 'nullable|boolean'
        ]);

        $newsPost->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'for_followers' => $request->for_followers ?? false
        ]);

        if ($request->has('title_photo')) {
            Image::query()
                ->where('news_post_id', '=', $newsPost->id)
                ->where('image_type', '=', "PostTitle")
                ->delete();

            FileController::upload($request, $newsPost);
        }
    }

    public function destroy(newsPost $newsPost)
    {
        $newsPost->delete();

        return redirect()->route('home')
            ->withSuccess('Post deleted successfully!');
    }
}
