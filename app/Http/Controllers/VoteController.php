<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:post,comment',
            'id' => 'required|integer',
            'is_upvote' => 'required|boolean',
        ]);

        $vote = new Vote();
        $vote->vote_type = $validated['type'] === 'post' ? 'PostVote' : 'CommentVote';
        $vote->is_upvote = $validated['is_upvote'];
        $vote->user_id = Auth::id();

        if ($vote->vote_type === 'PostVote') {
            $vote->news_post_id = $validated['id'];
        } else {
            $vote->comment_id = $validated['id'];
        }

        $vote->save();

        return response()->json(['message' => 'Saved', 'vote_id' => $vote->id]);
    }

    public function destroy(Vote $vote)
    {
        $this->authorize('delete', $vote);

        $vote->delete();

        return response()->json(['message' => 'Vote removed']);
    }

    public function update(Request $request, Vote $vote)
    {
        $this->authorize('update', $vote);

        $validated = $request->validate([
            'is_upvote' => 'required|boolean',
        ]);

        $vote->update([
            'is_upvote' => $validated['is_upvote'],
        ]);

        return response()->json(['message' => 'Vote updated', 'vote_id' => $vote->id]);
    }
}
