<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->author_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {

        if ($comment->upvotes != 0)
            return false;

        if ($comment->downvotes != 0)
            return false;

        if (count($comment->replies) > 0)
            return false;

        return $user->id === $comment->author_id;
    }
}
