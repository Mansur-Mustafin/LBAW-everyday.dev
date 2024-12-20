<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Database\QueryException;
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

        try {
            $vote->save();
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error on save', 'success' => false]);
        }

        return response()->json(['message' => 'Saved', 'vote_id' => $vote->id, 'success' => true]);
    }

    public function destroy(Vote $vote)
    {
        $this->authorize('delete', $vote);

        try {
            $vote->delete();
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error on delete', 'success' => false]);
        }

        return response()->json(['message' => 'Vote removed', 'success' => true]);
    }

    public function update(Request $request, Vote $vote)
    {
        $this->authorize('update', $vote);

        $validated = $request->validate([
            'is_upvote' => 'required|boolean',
        ]);

        try {
            $vote->update(['is_upvote' => $validated['is_upvote']]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error on update', 'success' => false]);
        }

        return response()->json(['message' => 'Vote updated', 'success' => true]);
    }
}
