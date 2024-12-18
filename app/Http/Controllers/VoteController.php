<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:post,comment',
            'id' => 'required|integer',
            'is_upvote' => 'required|boolean',
        ]);

        sleep(1);

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
            return response()->json(['message' => 'Error on save']);
        }

        return response()->json(['message' => 'Saved', 'vote_id' => $vote->id]);
    }

    public function destroy(Vote $vote)
    {
        $this->authorize('delete', $vote);

        sleep(1);

        try {
            $vote->delete();
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error on delete']);
        }

        return response()->json(['message' => 'Vote removed']);
    }

    public function update(Request $request, Vote $vote)
    {
        $this->authorize('update', $vote);

        sleep(1);

        $validated = $request->validate([
            'is_upvote' => 'required|boolean',
        ]);

        try {
            $vote->update(['is_upvote' => $validated['is_upvote']]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error on update']);
        }

        return response()->json(['message' => 'Vote updated']);
    }
}
