<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Comment;

class ReportController extends Controller
{
    public function show()
    {
        return view('pages.admin.admin', ['show' => 'reports']);
    }

    public function store(Request $request)
    {
        if ($request->report_type === 'CommentReport'){
            if($request->comment_post_id !== null){
                $post_id = $request->comment_post_id;
                $request->request->remove('comment_post_id');
            }
            else{
                $comment = Comment::find($request->comment_id);

                while ($comment && $comment->parent_comment_id !== null) {
                    $comment = Comment::find($comment->parent_comment_id);
                }

                $post_id = $comment ? $comment->news_post_id : null;
                $request->request->remove('comment_post_id');
            }
        }

        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'report_type' => 'required|string',
            'reporter_id' => 'required|integer|exists:user,id',
            'reported_user_id' => 'nullable|integer|exists:user,id',
            'news_post_id' => 'nullable|integer|exists:news_post,id',
            'comment_id' => 'nullable|integer|exists:comment,id',
        ]);

        $report = Report::create($validatedData);

        if ($request->report_type === 'PostReport' && $request->news_post_id) {
            return redirect()->route('news.show', $request->news_post_id)
                ->with('success', 'You have successfully reported the post!');
        }
        else if($request->report_type === 'CommentReport' && $request->comment_id){
            return redirect()->route('news.show', $post_id)
                ->with('success', 'You have successfully reported the comment!');
        }
        else if($request->report_type === 'UserReport' && $request->reported_user_id){
            return redirect()->route('user.posts', ['user' => $request->reported_user_id])
                ->with('success', 'You have successfully reported the user!');
        }
    }

    public function destroy(Report $report)
    {
        try {
            $report->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
