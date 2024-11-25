<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NewsPostPaginationTrait;

class NewsController extends Controller
{
    use NewsPostPaginationTrait;

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

    public function show(newsPost $news_post)
    {
        $tags = Tag::all();
        $existingTags = $news_post->tags->pluck('name')->toArray();
        $stillAvailableTags = $tags->filter(function ($tag) use ($existingTags) {
            return !in_array($tag->name, $existingTags);
        });

        $user = Auth::user();
        $news_post->user_vote = null;
        if ($user) {
            $vote = $news_post->votes()->where('user_id', $user->id)->first();

            if ($vote) {
                $news_post->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                $news_post->user_vote_id = $vote->id;
            }
        }

        return view('pages.post', [
            'post' => $news_post,
            'tags' => $tags,
            'availableTags' => $stillAvailableTags,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'for_followers' => 'required|string',
            'image' => 'required|file|mimes:jpg,png|max:2048',
            'tags' => 'nullable|string'
        ]);


        $post = NewsPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'for_followers' => $request->for_followers,
            'author_id' => Auth::user()->id,
        ]);

        FileController::upload($request, $post, Image::TYPE_POST_TITLE);

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
            'content' => 'required|string', 
            'for_followers' => 'nullable|boolean',
            'tags' => 'nullable|string',
            'title_photo' => 'required|file|mimes:jpg,png|max:2048',
        ]);

        $newsPost->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'for_followers' => $request->input('for_followers', false), 
        ]);

        if ($request->has('image')) {
            Image::query()
                ->where('news_post_id', '=', $newsPost->id)
                ->where('image_type', '=', "PostTitle")
                ->delete();

            FileController::upload($request, $newsPost, Image::TYPE_POST_TITLE);
        }

        if ($request->tags != null) {
            $tags = explode(',', $request->tags);
            $tagIds = Tag::whereIn('name', $tags)->pluck('id')->toArray();
            $newsPost->tags()->sync($tagIds);
        }

        return redirect()->route('news.show', ['news_post' => $newsPost->id])
            ->with('message', 'Post atualizado com sucesso!');
    }

    public function destroy(newsPost $newsPost)
    {
        $newsPost->delete();

        return redirect()->route('home')
            ->withSuccess('Post deleted successfully!');
    }
}
