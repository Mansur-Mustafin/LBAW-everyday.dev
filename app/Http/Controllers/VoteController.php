<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        $request->merge([
            'id' => (int) $request->id,
            'is_upvote' => $request->is_upvote == 'true' ? true : false
        ]);

        $validated = $request->validate([
            'type' => 'required|string|in:post,comment',
            'id' => 'required|integer',
            'is_upvote' => 'required|boolean',
        ]);

        $voteType = $validated['type'] === 'post' ? 'PostVote' : 'CommentVote';
        $itemId = $validated['id'];
        $isUpvote = $validated['is_upvote'];

        $vote = new Vote();
        $vote->vote_type = $voteType;
        $vote->is_upvote = $isUpvote;
        $vote->user_id = $user->id;

        if ($voteType === 'PostVote') {
            $vote->news_post_id = $itemId;
        } else {
            $vote->comment_id = $itemId;
        }

        $vote->save();

        return response()->json(['message' => 'Saved', 'vote_id' => $vote->id]);
    }

    public function destroy(Vote $vote)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        // TODO: rewrite with Policy
        if ($vote->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $vote->delete();

        return response()->json(['message' => 'Vote removed']);
    }

    public function update(Request $request, Vote $vote)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        if ($vote->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'is_upvote' => 'required|boolean',
        ]);

        $isUpvote = $validated['is_upvote'];

        // Begin a transaction
        DB::beginTransaction();

        try {
            // Delete the existing vote
            $vote->delete();

            // Create a new vote with the updated value
            $newVote = new Vote();
            $newVote->vote_type = $vote->vote_type;
            $newVote->is_upvote = $isUpvote;
            $newVote->user_id = $user->id;

            if ($vote->vote_type === 'PostVote') {
                $newVote->news_post_id = $vote->news_post_id;
            } else {
                $newVote->comment_id = $vote->comment_id;
            }

            $newVote->save();

            DB::commit();

            return response()->json(['message' => 'Vote updated', 'vote_id' => $newVote->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }


}
