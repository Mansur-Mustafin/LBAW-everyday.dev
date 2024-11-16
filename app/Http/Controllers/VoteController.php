<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        if(!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $user = Auth::user();

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

        return response()->json(['message' => 'Saved']);
    }
}
