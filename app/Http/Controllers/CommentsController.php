<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    function findMostParentComment($comment_id)
    {
        $comment = Comment::find($comment_id);

        while ($comment->parent_comment_id !== null) {
            $comment = Comment::find($comment->parent_comment_id);
        }
        return $comment;
    }

    function buildNestedComment($comment)
    {
        $thread_parent = $this->findMostParentComment($comment->id);

        return response()->json(['thread' => view('partials.comment', ['comment' => $thread_parent, 'level' => 0, 'post' => NewsPost::find($thread_parent->news_post_id), 'thread' => 'multi'])->render(), "thread_id" => $thread_parent->id]);
    }
    function buildComment($comment)
    {
        return response()->json(['thread' => view('partials.comment', ['comment' => $comment, 'level' => 0, 'post' => NewsPost::find($comment->news_post_id), 'thread' => 'multi'])->render(), "thread_id" => $comment->id]);
    }

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

        if ($request->news_post_id) {
            return $this->buildComment($comment);
        } else {
            return $this->buildNestedComment($comment);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string|max:250',
            'comment_id' => 'required|string'
        ]);

        $comment = Comment::find((int) $request->comment_id);

        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        $comment->update([
            'content' => $request->content,
        ]);

        return response()->json(['comment' => $comment]);
    }

    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}