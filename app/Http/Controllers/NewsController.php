<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class NewsController extends Controller
{
    public function index()
    {
        $newsPosts = NewsPost::orderBy('created_at', 'desc')->get();

        $user = Auth::user();

        foreach ($newsPosts as $news) {
            $news->user_vote = null;

            if ($user) {
                $vote = $news->votes()->where('user_id', $user->id)->first();

                if ($vote) {
                    $news->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                    $news->user_vote_id = $vote->id;
                }
            }
        }

        return view('pages.news', compact('newsPosts'));
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
            'content' => 'required|string', 
            'for_followers' => 'nullable|boolean',
            'tags' => 'nullable|string',
        ]);

        $newsPost->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'for_followers' => $request->input('for_followers', false), 
        ]);

        if ($request->has('title_photo')) {
            Image::query()
                ->where('news_post_id', '=', $newsPost->id)
                ->where('image_type', '=', "PostTitle")
                ->delete();

            FileController::upload($request, $newsPost);
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
