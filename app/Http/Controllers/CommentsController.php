<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function findMostParentComment($comment_id)
    {
        $comment = Comment::find($comment_id);

        while ($comment->parent_comment_id !== null) {
            $comment = Comment::find($comment->parent_comment_id);
        }

        return $comment;
    }

    public function buildNestedComment($comment, $thread)
    {
        $threadParent = $this->findMostParentComment($comment->id);

        NewsPostController::processComments([$threadParent], Auth::user());

        return $this->buildComment($threadParent, $thread);
    }

    public function buildComment($comment, $thread)
    {
        return response()->json([
            'thread' => view('partials.comment', [
                'comment' => $comment,
                'level' => 0,
                'post' => NewsPost::find($comment->news_post_id),
                'thread' => $thread
            ])->render(),
            "thread_id" => $comment->id
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:40',
            'news_post_id' => 'nullable|string',
            'parent_comment_id' => 'nullable|string',
            'thread' => 'required|string'
        ]);

        $comment = Comment::create([
            'content' => $validated['content'],
            'news_post_id' => $validated['news_post_id'] ?? null,
            'parent_comment_id' => $validated['parent_comment_id'] ?? null,
            'author_id' => Auth::id()
        ]);

        if ($comment['news_post_id']) {
            return $this->buildComment($comment, $validated['thread']);
        } else {
            return $this->buildNestedComment($comment, $validated['thread']);
        }
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'nullable|string|max:250'
        ]);

        $comment->update([
            'content' => $validated['content'],
        ]);

        return response()->json(['comment' => $comment]);
    }

    public function destroy(Comment $comment)
    {
        try {
            $this->authorize('delete', $comment);
            $comment->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);  // TODO: return 500?
        }
    }

    public function omit(Comment $comment)
    {
        $comment->update([
            'is_omitted'=>"true"
        ]);

        return response()->json(['success' => true]);
    }

    public function unomit(Comment $comment)
    {
        $comment->update([
            'is_omitted'=>"false"
        ]);

        return response()->json(['success' => true]);
    }

    public function showOmittedComments() {
        return view('pages.admin.admin', ['show' => 'omitted_comments']);
    }
}
