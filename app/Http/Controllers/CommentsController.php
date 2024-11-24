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
            'news_post_id' => 'nullable|string',
            'parent_comment_id' => 'nullable|string'
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'news_post_id' => $request->news_post_id ? (int) $request->news_post_id : null,
            'parent_comment_id' => $request->parent_comment_id ? (int) $request->parent_comment_id : null,
            'author_id' => Auth::user()->id
        ]);
        $type = $request->post_id ? 'non-nested' : 'nested';

        $parentComment = null;
        $repliesCount = 0;
        if ($request->parent_comment_id) {
            $parentComment = Comment::where('id', $request->parent_comment_id)->first();
            if ($parentComment) {
                $repliesCount = Comment::where('parent_comment_id', $parentComment->id)->count();
            }
        }

        return response()->json([
            'comment' => $request->content,
            'user' => Auth::user(),
            'type' => $type,
            'parent' => $parentComment ? [
                'id' => $parentComment->id,
                'replies' => $repliesCount
            ] : null,
            'id' => $comment->id
        ], 201);
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