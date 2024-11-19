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

    public function show(int $newsPost)
    {
        $post = NewsPost::findOrFail($newsPost);

        // if ($post->author_id !== Auth::user()->id) {
        //     return 'Only author can view post';
        // }

        return view('pages.post', ['post' => $post]);
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
