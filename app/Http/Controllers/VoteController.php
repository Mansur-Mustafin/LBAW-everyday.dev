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

        $voteType = $validated['type'] === 'post' ? 'PostVote' : 'CommentVote';
        $vote = new Vote([
            'vote_type' => $voteType,
            'is_upvote' => $validated['is_upvote'],
            'user_id' => Auth::id(),
        ]);

        $voteType === 'PostVote'
            ? $vote->news_post_id = $validated['id']
            : $vote->comment_id = $validated['id'];

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
