<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $newsPosts = NewsPost::orderBy('created_at', 'desc')->get();

        return view('home', compact('newsPosts'));
    }

    public function show(int $newsPost)
    {
        $post = NewsPost::findOrFail($newsPost);

        // if ($post->author_id !== Auth::user()->id) {
        //     return 'Only author can view post';
        // }

        return view('pages.post', ['post' => $post]);
    }
}
