<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string|max:40',
            'for_followers' => 'required|email|max:250|unique:user'
        ]);

        Comment::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'for_followers' => $request->for_followers
        ]);
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string|max:40',
            'for_followers' => 'required|email|max:250|unique:user'
        ]);

        $comment->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'for_followers' => $request->for_followers
        ]);
    }

    public function destroy(Comment $comment) {
        return $comment->delete();
    }
}
