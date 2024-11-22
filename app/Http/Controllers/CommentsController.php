<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:40',
            'news_post_id' => 'nullable|int',
            'parent_comment_id' => 'nullable|int'
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'news_post_id' => $request->post_id,
            'parent_comment_id' => $request->parent_comment_id,
            'author_id' => Auth::user()->id
        ]);

        $type = $request->post_id ? 'non-nested' : 'nested';

        return response()->json(['comment' => $request->content, 'user' => Auth::user(), 'type' => $type, 'parent_id' => $request->parent_comment_id, 'id' => $comment->id], 201);
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

    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}